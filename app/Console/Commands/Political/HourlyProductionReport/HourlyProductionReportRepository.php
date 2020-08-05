<?php

namespace App\Console\Commands\Political\HourlyProductionReport;

use App\Connections\RingCentralConnection;
use Illuminate\Support\Facades\DB;

class HourlyProductionReportRepository extends RingCentralConnection
{
    public $data;
    public $dispositions;

    protected $date_from;

    protected $date_to;

    public function __construct(array $options)
    {
        $this->date_from = $options['date_from'];
        $this->date_to = $options['date_to'];
        $this->data = $this->getData();
        $this->dispositions = $this->getDispositions();
    }

    private function getData()
    {
        return $this->connection()->select(
            DB::raw("
                declare @fromDate as smalldatetime, @toDate as smalldatetime, @campaign as varchar(50)
                set @fromDate = '{$this->date_from}'
                set @toDate = '{$this->date_to}'
                set @campaign = 'POL%'
                
                exec [sp_Hours_Summary] @fromDate, @toDate, @campaign
            ")
        );
    }

    protected function getDispositions()
    {
        return $this->connection()->select(
            DB::raw("        
                declare @fromDate as smalldatetime, @toDate as smalldatetime, @campaign as varchar(50)
                set @fromDate = '{$this->date_from}'
                set @toDate = '{$this->date_to}'
                set @campaign = 'POL%'
                
                exec [sp_Dispositions_Summary] @fromDate, @toDate, @campaign
            ")
        );
    }
}
