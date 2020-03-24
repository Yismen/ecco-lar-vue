<?php

namespace App\Exports\Political;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
use App\Exports\Political\Sheets\FlashCampaignsSheet;
use App\Exports\Political\Sheets\FlashHoursSheet;
use App\Repositories\Political\DropNullColumnsOnFlashDispositions;
use App\Repositories\Political\PoliticalFlashInterface;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class FlashReportExport implements WithMultipleSheets
{
    use CapillusCommandsTrait;

    /**
     * Array of hours
     *
     * @var array
     */
    protected $repo;

    public function __construct(PoliticalFlashInterface $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new FlashHoursSheet($this->repo->hours);

        $dispositions = collect($this->repo->dispositions)->groupBy('campaign_name');
        $answersCollection = collect($this->repo->answers)->groupBy('campaign_name');
        
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
