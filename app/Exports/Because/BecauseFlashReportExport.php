<?php

namespace App\Exports\Because;

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

class BecauseFlashReportExport implements FromView, WithColumnFormatting, WithTitle, WithEvents
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('exports.because-flash.index', [
            'current_date' => Carbon::now()->format('d-M-Y'),
            'previous_date' => Carbon::now()->subDay()->format('d-M-Y'),
            'todays' => $this->data['todays'],
            'yesterdays' => $this->data['yesterdays']
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                // format the whole tables
                $event->sheet->getDelegate()->getStyle('A4:O13')->applyFromArray($this->tableStyle());
                $event->sheet->getDelegate()->getStyle('A16:O25')->applyFromArray($this->tableStyle());
                // Format headers
                $event->sheet->getDelegate()->getStyle('A4:O4')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getStyle('A16:O16')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getRowDimension('4')->setRowHeight(60);
                $event->sheet->getDelegate()->getRowDimension('16')->setRowHeight(60);
                // format the total rows
                $event->sheet->getDelegate()->getStyle('A13:O13')->applyFromArray($this->totalStyle());
                $event->sheet->getDelegate()->getStyle('A25:O25')->applyFromArray($this->totalStyle());
                // format the window columns
                $event->sheet->getDelegate()->getStyle('A5:A12')->applyFromArray($this->windowCellsStyle());
                $event->sheet->getDelegate()->getStyle('A17:A24')->applyFromArray($this->windowCellsStyle());
                //set Columns Width
                $event->sheet->getDelegate()->getDefaultColumnDimension()->setWidth(13);
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(15);
                $event->sheet->getDelegate()->getPageSetup()
                    ->setFitToWidth(1)
                    ->setFitToHeight(1)
                    ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);
                $event->sheet->getDelegate()->getPageMargins()
                    ->setRight(0.17)
                    ->setLeft(0.17);
                $event->sheet->getDelegate()->getSheetView()->setZoomScale(90);
            }
        ];
    }
    
    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_PERCENTAGE_00,
            'G' => NumberFormat::FORMAT_PERCENTAGE_00,
            'I' => NumberFormat::FORMAT_PERCENTAGE_00,
            'J' => NumberFormat::FORMAT_PERCENTAGE_00,
            'K' => NumberFormat::FORMAT_PERCENTAGE_00,
            'L' => NumberFormat::FORMAT_PERCENTAGE_00,
            'M' => NumberFormat::FORMAT_PERCENTAGE_00,
        ];
    }

    public function title(): string
    {
        return 'KNYC E Flash Report - Because';
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
                    'rgb' => 'B1A0C7',
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
                    'rgb' => '660066',
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
