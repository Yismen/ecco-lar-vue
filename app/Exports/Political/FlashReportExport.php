<?php

namespace App\Exports\Political;

use App\Console\Commands\CapillusCommandsTrait;
use App\Exports\Political\Sheets\FlashCampaignsSheet;
use App\Exports\Political\Sheets\FlashHoursSheet;
use App\Repositories\Political\DropNullColumnsOnFlashDispositions;
use App\Repositories\Political\PoliticalCampaignsRepository;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FlashReportExport implements WithMultipleSheets
{
    use CapillusCommandsTrait;
        
    protected $date_from;
    
    protected $date_to;
    
    public function __construct(array $options)
    {
        $this->date_from = $options['date_from'];
        $this->date_to = $options['date_to'];
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new FlashHoursSheet(['date_from' => $this->date_from, 'date_to' => $this->date_to]);

        $repo = new PoliticalCampaignsRepository(['date' => $this->date_to]);
        $dispositions = collect($repo->dispositions)->groupBy('campaign_name');
        $answersCollection = collect($repo->answers)->groupBy('campaign_name');
        
        foreach ($dispositions as $name => $disposition) {
            $answers = $answersCollection->get($name);
            
            $answers = (new DropNullColumnsOnFlashDispositions())
                ->handle($answers->all())
                ->padKeys('num_leads')
                ->data
                ;
                
            $sheets[] = new FlashCampaignsSheet($disposition, $answers, $name);
        }
        
        return $sheets;
    }
}
