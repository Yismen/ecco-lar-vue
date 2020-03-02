<?php

namespace App\Exports\Political\Sheets;

use App\Repositories\Capillus\CapillusPerformanceReportRepository;
use App\Repositories\Political\PoliticalHoursRepository;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class FlashHoursSheet implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $repo;

    protected $sheet;
    
    protected $rows;

    public function __construct(array $options)
    {        
        $this->repo = new PoliticalHoursRepository([
            'date_from' => $options['date_from'],
            'date_to' => $options['date_to']
        ]);

        $this->rows = count($this->repo->data) + 1;
    }   

    public function view(): View
    {
        return view('exports.political.hours', [
            'data' => $this->repo->data,
            'title' => "Hours"
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                // auto
                $this->sheet = $event->sheet->getDelegate();

                $this->configurePage()
                    ->setColumnsWidth()
                    ;
                    
                $this->sheet->getStyle('A1:B1')->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
                $this->sheet->getStyle('A1:B1')->applyFromArray($this->headerStyle());
                $this->sheet->getStyle("B2:B{$this->rows}")->getNumberFormat()->setFormatCode('#,##0.00');
                $this->sheet->getStyle("A2:B{$this->rows}")->applyFromArray([
                    'borders' => [
                        'outline' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                        'inside' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ]
                    ]
                ]);

            }
        ];
    }

    public function title(): string
    {
        return "Hours";
    }

    protected function setColumnsWidth()
    {
        foreach (range('A', 'B') as $col) {
            $this->sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }

        return $this;
    }

    protected function configurePage()
    {
        $this->sheet->getPageSetup()
            ->setPrintArea("A1:K{$this->rows}")
            ->setFitToWidth(1)
            ->setFitToHeight(5)
            ->setOrientation(PageSetup::ORIENTATION_DEFAULT);

        $this->sheet->getPageMargins()
            ->setTop(0.5)
            ->setBottom(0.17)
            ->setRight(0.17)
            ->setLeft(0.17);

        return $this;
    }

    protected function headerStyle()
    {
        return [
            'font' => [
                'bold' => true
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => '000000',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_LEFT
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'inside' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];
    }
}
