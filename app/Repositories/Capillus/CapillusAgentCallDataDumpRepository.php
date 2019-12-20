<?php

namespace App\Repositories\Capillus;

use Illuminate\Support\Facades\DB;

class CapillusAgentCallDataDumpRepository extends CapillusBase
{
    public $data;

    protected $date;

    protected $campaign;

    public function __construct(array $options)
    {
        $this->date = $options['date'];
        $this->campaign = $options['campaign'];

        $this->data = $this->getData();
    }

    protected function getData() 
    {     

        return $this->connection()->select(
            DB::raw("
                declare @rdate as smalldatetime, 
                    @camp as varchar(50)

                set @rdate = '{$this->date}'
                set @camp = '{$this->campaign}'

                exec sp_CapillusCallLog @rdate, @camp
            ")
        );
    }
}