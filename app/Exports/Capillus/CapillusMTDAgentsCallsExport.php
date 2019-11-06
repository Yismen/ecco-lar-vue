<?php

namespace App\Exports\Capillus;

use App\Repositories\Capillus\CapillusMTDAgentsCallsRepository;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class CapillusMTDAgentsCallsExport implements FromArray, WithHeadings, ShouldAutoSize, WithTitle
{
    protected $repo;

    protected $campaign;

    protected $from;

    protected $to;

    public function __construct($campaign, $from, $to)
    {
        $this->repo = new CapillusMTDAgentsCallsRepository;

        $this->campaign = $campaign;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * Data
     *
     * @return array
     */
    public function array(): array
    {
        return $this->repo->report($this->campaign, $this->from, $this->to);
    }

    public function title(): string
    {
        $from = Carbon::parse($this->from)->format('Ymd');
        $to = Carbon::parse($this->to)->subday()->format('Ymd');

        return "MTD Calls {$from}_{$to}";
    }

    /**
     * Headings
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Agent ID',
            'First Name',
            'Last Name',
            'Total Calls Handled',
            'Total Cap Ultra Sales',
            'Total Cap Plus Sales',
            'Total Cap Pro Sales',
        ];
    }
}
