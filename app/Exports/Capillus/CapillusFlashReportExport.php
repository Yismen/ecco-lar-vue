<?php

namespace App\Exports\Capillus;

use App\Repositories\Capillus\CapillusFlashRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class CapillusFlashReportExport implements FromView, WithColumnFormatting, WithTitle, WithEvents
{
    protected $repo;

    public function __construct()
    {
        $this->repo = new CapillusFlashRepository();
    }

    public function view(): View
    {
        return view('exports.capillus-flash.index', [
            'current_date' => Carbon::now()->format('d-M-Y'),
            'previous_date' => Carbon::now()->subDay()->format('d-M-Y'),
            'todays' => $this->repo->todaysData(),
            'yesterdays' => $this->repo->yesterdaysData()
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {  
                
                // format the whole tables
                $event->sheet->getDelegate()->getStyle('A4:S13')->applyFromArray($this->tableStyle());
                $event->sheet->getDelegate()->getStyle('A16:S25')->applyFromArray($this->tableStyle());
                // Format headers              
                $event->sheet->getDelegate()->getStyle('A4:S4')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getStyle('A16:S16')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(60);
                $event->sheet->getDelegate()->getRowDimension('16')->setRowHeight(60);
                // format the total rows
                $event->sheet->getDelegate()->getStyle('A13:S13')->applyFromArray($this->totalStyle());
                $event->sheet->getDelegate()->getStyle('A25:S25')->applyFromArray($this->totalStyle());
                // format the window columns
                $event->sheet->getDelegate()->getStyle('A5:A12')->applyFromArray($this->windowCellsStyle());
                $event->sheet->getDelegate()->getStyle('A17:A24')->applyFromArray($this->windowCellsStyle());
                //set Columns Width
                $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(10);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(15);
                $event->sheet->getDelegate()->getPageSetup()
                    ->setFitToWidth(1)
                    ->setFitToHeight(1)
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageMargins()
                    ->setRight(0.17)
                    ->setLeft(0.17);
            }
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_PERCENTAGE_00,
            'G' => NumberFormat::FORMAT_PERCENTAGE_00,
            'H' => NumberFormat::FORMAT_PERCENTAGE_00,
            'I' => NumberFormat::FORMAT_PERCENTAGE_00,

            'N' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'O' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'P' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
            'Q' => NumberFormat::FORMAT_CURRENCY_USD_SIMPLE,
        ];
    }

    public function title(): string
    {
        return 'KNYC E Flash Report';
    }

    protected function headerStyle()
    {
        return [
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'B4C6E7',
                ],
            ],
        ];
    }

    protected function tableStyle()
    {
        return [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'alignment' => [
                'wrapText' => true
            ]
        ];
    }

    protected function totalStyle()
    {
        return [
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THICK,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF']
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => '203764',
                ],
            ],
        ];
    }

    protected function windowCellsStyle()
    {
        return [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'D9D9D9',
                ],
            ],
        ];
    }
}
