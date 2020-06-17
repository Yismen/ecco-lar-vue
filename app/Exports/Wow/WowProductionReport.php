<?php

namespace App\Exports\Wow;

use App\Console\Commands\Capillus\CapillusCommandsTrait;
use App\Exports\Wow\Sheets\WowDataSheet;
use App\Exports\Wow\Sheets\WowDispositionsSheet;
use App\Repositories\Wow\WowRepository;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class WowProductionReport implements WithMultipleSheets
{
    use CapillusCommandsTrait;

    /**
     * Array of hours
     *
     * @var array
     */
    protected $repo;

    public function __construct(WowRepository $repo)
    {
        $this->repo = $repo;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new WowDataSheet($this->repo->data);
        $sheets[] = new WowDispositionsSheet($this->repo->dispositions);
        
        return $sheets;
    }
}
