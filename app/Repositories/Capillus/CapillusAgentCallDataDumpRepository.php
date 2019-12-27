<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusAgentCallDataDumpRepository extends CapillusBase
{
    public $data;

    /**
     * the date up to where run the report
     *
     * @var Date
     */
    protected $date;
    /**
     * A dated representing when the month started.
     *
     * @var Date
     */
    protected $startOfMonth;
    /**
     * The campaign to parse the data. This can contain a wildcard %.
     *
     * @var String
     */
    protected $campaign;

    public function __construct(array $options)
    {
        $this->date = $options['date'];

        $this->startOfMonth = $options['startOfMonth'];

        $this->campaign = $options['campaign'];

        $this->data = $this->getData();
    }

    protected function getData() 
    {     

        return $this->connection()->select(
            DB::raw("
                declare @startDate as smalldatetime, 
                    @endDate as smalldatetime,
                    @camp as varchar(50)

                set @startDate = '{$this->startOfMonth}'
                set @endDate = '{$this->date}'
                set @camp = '{$this->campaign}'

                exec sp_CapillusCallLog @startDate, @endDate, @camp
            ")
        );
    }
}