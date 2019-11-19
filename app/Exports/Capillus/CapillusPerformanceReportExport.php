<?php

namespace App\Exports\Capillus;

use App\Repositories\Capillus\CapillusPerformanceReportRepository;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class CapillusPerformanceReportExport implements FromView, WithTitle, WithEvents
{
    protected $repo;

    protected $sheet;

    public function __construct(Carbon $date)
    {
        $this->repo = new CapillusPerformanceReportRepository($date);
    }

    public function view(): View
    {
        return view('exports.capillus.daily-performance', [
            'data' => $this->repo->data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {  
                
                // auto
                $this->sheet = $event->sheet->getDelegate();

                $this->addFormulas()
                    ->configurePage()
                    ->setColumnsWidth()
                    ->formatAbandonRates()
                    ->formatCallsPercentages()
                    ->formatCapResults()
                    ->formatDividers()
                    ->formatMinutes()
                    ->formatTotalRevenues()
                    ->formatRevenueDetails()
                    ->formatConversionRates()
                    ->formatCallsAndHeader()
                    ->setVerticalBorders()
                    ->formatLegends();

                $event->sheet->getDelegate()->getStyle('A1:k1')->applyFromArray($this->headerStyle());
                $event->sheet->getDelegate()->getStyle('A1:A70')->applyFromArray($this->setBold());
                $event->sheet->getDelegate()->getStyle('I1:K70')->applyFromArray($this->setBold());                
            }
        ];
    }

    public function title(): string
    {
        return 'Capillus Daily Performance';
    }

    protected function setColumnsWidth()
    {
        $this->sheet->getDefaultColumnDimension()->setWidth(10.75);
        $this->sheet->getColumnDimension('A')->setWidth(42);
        // $this->sheet->getColumnDimension('I')->setWidth(9.25);
        // $this->sheet->getColumnDimension('J')->setWidth(9.25);
        // $this->sheet->getColumnDimension('K')->setWidth(9.25); //hidden for now

        return $this;
    }
    
    protected function formatLegends()
    {
        $this->sheet->getStyle('L1:L70')->applyFromArray([
            'font' => [
                'size' => 8,
                'color' => [
                    'rgb' => '152EFD'
                ]
            ],
        ]);

        return $this;
    }

    protected function configurePage()
    {
        $this->sheet->getPageSetup()
            ->setPrintArea('A1:K53')
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
        // Short Abandon Rate
        $this->setDivisionFormulas([ 'row' => 6, 'dividend' => 5, 'divisor' => 3 ]);
        // Long Abandon Rate
        $this->setDivisionFormulas([ 'row' => 8, 'dividend' => 7, 'divisor' => 3 ]);
        // % Qualified Calls
        $this->setDivisionFormulas([ 'row' => 9, 'dividend' => 39, 'divisor' => 4 ]);
        // % Non Qualified Calls
        $this->setDivisionFormulas([ 'row' => 10, 'dividend' => 53, 'divisor' => 4 ]);
        // Total Cap Sales
        $this->setSumFormula([ 'row' => 15, 'from_row' => 16, 'to_row' => 18 ]);
        // Revenue per call received
        $this->setDivisionFormulas([ 'row' => 20, 'dividend' => 19, 'divisor' => 3 ]);
        // Revenue per call answered
        $this->setDivisionFormulas([ 'row' => 21, 'dividend' => 19, 'divisor' => 4 ]);
        // Revenue per call qualified calls
        $this->setDivisionFormulas([ 'row' => 22, 'dividend' => 19, 'divisor' => 39 ]);
        // Conversion - Against Calls Received
        $this->setDivisionFormulas([ 'row' => 23, 'dividend' => 15, 'divisor' => 3 ]);
        // Conversion - Against Calls Answered
        $this->setDivisionFormulas([ 'row' => 24, 'dividend' => 15, 'divisor' => 4 ]);
        // Conversion - Against Qualified Calls
        $this->setDivisionFormulas([ 'row' => 25, 'dividend' => 15, 'divisor' => 39 ]);
        // Qualified Calls
        $this->setSumFormula([ 'row' => 39, 'from_row' => 27, 'to_row' => 38 ]);
        // Non Qualified Calls
        $this->setSumFormula([ 'row' => 53, 'from_row' => 40, 'to_row' => 52 ]);

        return $this;
    }

    protected function setDivisionFormulas(array $options)
    {
        foreach (range('B', 'K') as $letter) {
            $this->sheet->setCellValue("{$letter}{$options['row']}", "={$letter}{$options['dividend']} / {$letter}{$options['divisor']}");
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
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'AEAAAA',
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
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

    protected function formatAbandonRates()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'FFEBEB',
                ],
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
            ]
        ];

        $this->sheet->getStyle('A6:K6')->applyFromArray($format);
        $this->sheet->getStyle('B6:K6')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
        $this->sheet->getStyle('A8:K8')->applyFromArray($format);
        $this->sheet->getStyle('B8:K8')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
        
        return $this;
    }

    protected function formatCallsAndHeader()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'E7E6E6',
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

        $this->sheet->getStyle('A2:K2')->applyFromArray($format);         
        $this->sheet->getStyle('A39:K39')->applyFromArray($format);
        $this->sheet->getStyle('A53:K53')->applyFromArray($format);

        $this->sheet->getStyle('B2:K2')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_MYMINUS);
        $this->sheet->getStyle('B2:K2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_RIGHT);         
        $this->sheet->getStyle('A2:K2')->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ]);

        return $this;
    }

    protected function formatCapResults()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'EAF4E4',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_DOUBLE,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A15:K15')->applyFromArray($format);

        return $this;
    }

    protected function formatCallsPercentages()
    {
        $this->sheet->getStyle('B9:K10')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
        
        return $this;
    }

    protected function formatDividers()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'D0CECE',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A14:K14')->applyFromArray($format);
        $this->sheet->getStyle('A26:K26')->applyFromArray($format);

        return $this;
    }

    protected function setVerticalBorders()
    {
        $format = [
            'borders' => [
                'right' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A2:A53')->applyFromArray($format);
        $this->sheet->getStyle('I2:I53')->applyFromArray($format);
        $this->sheet->getStyle('J2:J53')->applyFromArray($format);
        $this->sheet->getStyle('K2:K53')->applyFromArray($format);
        $this->sheet->getStyle('H2:H53')->applyFromArray([
            'borders' => [
                'right' => [
                    'borderStyle' => Border::BORDER_MEDIUM,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ]);

        return $this;
    }

    protected function formatMinutes()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'E3E9F5',
                ],
            ],            
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'bottom' => [
                    'borderStyle' => Border::BORDER_HAIR,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A11:K11')->applyFromArray($format);
        $this->sheet->getStyle('A11:K13')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_NUMBER_00);

        return $this;
    }

    protected function formatTotalRevenues()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'EAF4E4',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A19:K19')->applyFromArray($format);

        $this->sheet->getStyle('A19:K19')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        return $this;
    }

    protected function formatRevenueDetails()
    {
        $format = [
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'FFFFEB',
                ],
            ],
            'font' => [
                'bold' => true,
            ],
            'borders' => [
                'outline' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ]
        ];

        $this->sheet->getStyle('A20:K22')->applyFromArray($format);

        $this->sheet->getStyle('A20:K22')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD_SIMPLE);

        return $this;
    }

    protected function formatConversionRates()
    {
        $this->sheet->getStyle('B23:K25')->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);

        return $this;
    }
}
