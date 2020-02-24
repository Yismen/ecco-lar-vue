<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusLeadsRepository extends CapillusBase
{
    public $data;

    

    protected $date_from;

    protected $date_to;

    public function __construct(array $options)
    {
        $this->date_from = $options['date_from'];
        $this->date_to = $options['date_to'];
        
        $this->data = $this->getData();
    }

    protected function getData() 
    {     

        return $this->connection()->select(
            DB::raw("
                select * from Reports.dbo.vw_CapillusLeads
                where [connected_disposition] <> ''  
                and connected_disposition not like 'Sale %'
                and convert(date, [Date]) between '{$this->date_from}' and '{$this->date_to}'
                order by convert(date, [Date]) desc
            ")
        );
    }
}