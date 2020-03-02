<?php

namespace App\Repositories\Political;

use App\CapillusDailyPerformance;
use App\Repositories\Capillus\CapillusBase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PoliticalCampaignsRepository extends CapillusBase
{
    public $data;

    protected $date;

    public function __construct(array $options)
    {
        $this->date = $options['date'];

        $this->dispositions = $this->getDispositions();
        
        $this->answers = $this->getAnswers();
    }

    protected function getDispositions()
    {
        return $this->connection()->select(
            DB::raw("
                declare @reportDate as date
                set @reportDate = '{$this->date}'
                
                select
                    campaign_name,
                    disposition,
                    sum(num_leads) as num_leads
                FROM
                    POL_AllCampaignFlash
                WHERE
                            report_date = @reportDate
                group by 
                            campaign_name, 
                            disposition
                order by 
                            campaign_name desc, 
                            disposition
            ")
        );
    }

    public function getAnswers()
    {
        return $this->connection()->select(
            DB::raw("
                declare @reportDate as date
                set @reportDate = '{$this->date}'
                
                select
                    *
                FROM
                    POL_AllCampaignFlash
                WHERE
                            report_date = @reportDate
                order by 
                            campaign_name desc
            ")
        );
    }
}
