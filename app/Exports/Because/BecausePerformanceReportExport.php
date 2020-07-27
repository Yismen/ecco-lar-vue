<?php

namespace App\Exports\Because;

use App\Exports\ConditionalFormats\ConditionalFontsColor;
use App\Exports\Support\Formats\Borders;
use App\Exports\Support\Formats\Conditionals\ConditionalFontsColor as ConditionalsConditionalFontsColor;
use App\Exports\Support\Formats\TextOrNumberFormat;
use App\Repositories\Because\BecausePerformanceReportRepository;
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

class BecausePerformanceReportExport implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $repo;

    protected $sheet;

    public function __construct(array $options)
    {
        $this->sheet = $options['campaign'] == '%' ? 'Overall' : $options['campaign'];
        
        $this->repo = new BecausePerformanceReportRepository([
            'date' => $options['date'],
            'campaign' => $options['campaign']
        ]);
    }

    public function view(): View
    {
        return view('exports.because.daily-performance', [
            'data' => $this->repo->data,
            'title' => $this->sheet
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                // auto
                $this->sheet = $event->sheet->getDelegate();

                $this->addFormulas()
                    ->configurePage()
                    ->addBackgrounds()
                    ->addConditionalFormats()
                    ->addBorders()
                    ->addNumberFormats()
                    ->setColumnsWidth()
                ;

                $event->sheet->getDelegate()->mergeCells('A1:K1');
                $event->sheet->getDelegate()->getStyle('A1:K1')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getRowDimension(2)->setRowHeight(5);
                $event->sheet->getDelegate()->getStyle('A3:K3')->applyFromArray([
                    'font' => [
                        'size' => 18,
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER
                    ]
                ]);
            }
        ];
    }

    public function title(): string
    {
        return $this->sheet;
    }

    protected function setColumnsWidth()
    {
        $this->sheet->getColumnDimension('A')
            ->setAutoSize(true);

        foreach (range('B', 'H') as $col) {
            $this->sheet->getColumnDimension($col)
                    ->setWidth(10);
        }

        foreach (range('I', 'K') as $col) {
            $this->sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }

        return $this;
    }

    protected function configurePage()
    {
        $this->sheet->getPageSetup()
            ->setPrintArea('A1:K55')
            ->setFitToWidth(1)
            ->setFitToHeight(5)
            ->setOrientation(PageSetup::ORIENTATION_PORTRAIT);

        $this->sheet->getPageMargins()
            ->setTop(0.5)
            ->setBottom(0.17)
            ->setRight(0.17)
            ->setLeft(0.17);

        return $this;
    }

    protected function addFormulas()
    {
        // Automated Greeting Disconnect Rate
        $this->setDivisionFormulas([ 'row' => 9, 'dividend' => 8, 'divisor' => 6 ]);
        // Abandonment Rate
        $this->setDivisionFormulas([ 'row' => 11, 'dividend' => 10, 'divisor' => 6 ]);
        // % of Qualified Calls
        $this->setDivisionFormulas([ 'row' => 12, 'dividend' => 34, 'divisor' => 7 ]);
        // % of Non-Qualified Calls
        $this->setDivisionFormulas([ 'row' => 13, 'dividend' => 48, 'divisor' => 7 ]);
        // Gross Conversion Rate
        $this->setDivisionFormulas([ 'row' => 14, 'dividend' => 20, 'divisor' => 6 ]);
        // Net Conversion Rate
        $this->setDivisionFormulas([ 'row' => 15, 'dividend' => 20, 'divisor' => 7 ]);
        // Qualified Conversion Rate
        $this->setDivisionFormulas([ 'row' => 16, 'dividend' => 20, 'divisor' => 34 ]);

        // Total Overall Minutes
        $this->setSumFormula([ 'row' => 34, 'from_row' => 20, 'to_row' => 33 ]);
        // Total Cap Sales
        $this->setSumFormula([ 'row' => 48, 'from_row' => 35, 'to_row' => 47 ]);

        return $this;
    }

    protected function setDivisionFormulas(array $options)
    {
        foreach (range('B', 'K') as $letter) {
            $this->sheet->setCellValue(
                "{$letter}{$options['row']}",
                "=IFERROR({$letter}{$options['dividend']}/{$letter}{$options['divisor']}, 0)"
            );
        }
    }

    protected function setQualifiedCallsSumFormula(array $options)
    {
        foreach (range('B', 'K') as $letter) {
            $this->sheet->setCellValue("{$letter}{$options['row']}", "=SUM({$letter}{$options['from_row']}:{$letter}{$options['to_row']})+{$letter}17");
        }
    }

    protected function setSumFormula(array $options)
    {
        foreach (range('B', 'K') as $letter) {
            $this->sheet->setCellValue("{$letter}{$options['row']}", "=SUM({$letter}{$options['from_row']} : {$letter}{$options['to_row']})");
        }
    }

    protected function setBold()
    {
        return [
            'font' => [
                'bold' => true,
            ],
        ];
    }

    protected function headerStyle()
    {
        return [
            'font' => [
                'bold' => true,
                'size' => 22
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];
    }

    protected function addBackgrounds()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'DCE7F8',
                ]
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'top' => [
                    'borderStyle' => Border::BORDER_HAIR,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'font' => [
                'bold' => true,
            ]
        ];

        // $this->sheet->getStyle('A2:K2')->applyFromArray($format);
        $this->sheet->getStyle('A4:K4')->applyFromArray([
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => '9EBDEA',
                ]
            ],
        ]);
        $this->sheet->getStyle('A20:K20')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'FFF2CC',
                ]
            ]
        ]);
        $this->sheet->getStyle('A19:K19')->applyFromArray($format);
        $this->sheet->getStyle('A34:K34')->applyFromArray($format);
        $this->sheet->getStyle('A48:K48')->applyFromArray($format);

        $this->sheet->getStyle('B5:K5')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_MYMINUS);
        $this->sheet->getStyle('B5:K48')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $this->sheet->getStyle('A5:K5')->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'font' => [
                'bold' => true,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'A9FBFD',
                ]
            ]
        ]);

        return $this;
    }


    protected function addNumberFormats()
    {
        TextOrNumberFormat::apply($this->sheet, 'B9:K9', NumberFormat::FORMAT_PERCENTAGE_00);
        TextOrNumberFormat::apply($this->sheet, 'B11:K16', NumberFormat::FORMAT_PERCENTAGE_00);
        TextOrNumberFormat::apply($this->sheet, 'B17:K17', NumberFormat::FORMAT_NUMBER_00);

        return $this;
    }

    protected function addConditionalFormats()
    {
        ConditionalsConditionalFontsColor::apply($this->sheet, 'B6:K8');
        ConditionalsConditionalFontsColor::apply($this->sheet, 'B10:K10');
        ConditionalsConditionalFontsColor::apply($this->sheet, 'B17:K48');

        return $this;
    }

    protected function addBorders()
    {
        Borders::apply($this->sheet, 'A6:A17', 'right');
        Borders::apply($this->sheet, 'A20:A48', 'right');
        Borders::apply($this->sheet, 'A20:A48', 'right');
        Borders::apply($this->sheet, 'I20:K48', 'right');

        Borders::apply($this->sheet, 'A12:K13', 'outline');
        Borders::apply($this->sheet, 'A5:K17', 'outline');

        Borders::apply($this->sheet, 'H5:H17', 'right', Border::BORDER_MEDIUM);
        Borders::apply($this->sheet, 'H20:H48', 'right', Border::BORDER_MEDIUM);

        return $this;
    }
}
