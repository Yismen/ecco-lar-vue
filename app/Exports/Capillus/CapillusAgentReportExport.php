<?php

namespace App\Exports\Capillus;

use App\Repositories\Capillus\CapillusAgentReportRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class CapillusAgentReportExport implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $repo;
    protected $options;

    protected $sheet;
    protected $sheet_name;
    protected $rows;
    protected $last_column;

    public function __construct(array $options)
    {
        $this->options = $options;

        $this->repo = new CapillusAgentReportRepository([
            'from_date' => $this->getInitialDate($options['period']),
            'to_date' => $this->getFormatedDate($options['date'])->format('m/d/Y')
        ]);

        $this->rows = count($this->repo->data) + 2;

        $this->last_column = "T";
    }

    protected function getFormatedDate($date)
    {
        return Carbon::parse($date);
    }

    protected function getInitialDate($period)
    {
        switch ($period) {
            case 'pd':
                $this->sheet_name = "Previous Day";
                return $this->getFormatedDate($this->options['date'])->format('m/d/Y');
                break;
            case 'wtd':
                $this->sheet_name = "WTD";
                return $this->getFormatedDate($this->options['date'])->startOfWeek()->format('m/d/Y');
                break;
            case 'mtd':
                $this->sheet_name = "MTD";
                return $this->getFormatedDate($this->options['date'])->startOfMonth()->format('m/d/Y');
                break;
            case 'ptd':
                $this->sheet_name = "PTD";
                return $this->getFormatedDate('10/14/2019')->startOfWeek()->format('m/d/Y');
                break;
            
            default:
                throw new Exception("Unknown Period passed!", 1);
                break;
        }
    }

    public function view(): View
    {
        return view('exports.capillus.agent-report', [
            'data' => $this->repo->data
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
                    ->formatHeaders()
                    ->formatSubHeaders()
                    ->mergeCells()
                    ->setVerticalBorders()
                    ->applySpecialFormats()
                    ->applyConditionalFormats()
                    ;

                // $event->sheet->getDelegate()->getStyle('A1:k1')->applyFromArray($this->headerStyle());
                // $event->sheet->getDelegate()->getStyle('A1:A70')->applyFromArray($this->setBold());
                // $event->sheet->getDelegate()->getStyle('I1:K70')->applyFromArray($this->setBold());
            }
        ];
    }

    public function title(): string
    {
        return $this->sheet_name;
    }

    protected function setColumnsWidth()
    {
        $this->sheet->getDefaultColumnDimension()->setWidth(9.25);
        $this->sheet->getColumnDimension('A')
            ->setAutoSize(true);
        $this->sheet->getColumnDimension('b')
            ->setWidth(11);

        return $this;
    }

    protected function configurePage()
    {
        $this->sheet->getPageSetup()
            ->setPrintArea("A1:{$this->last_column}{$this->rows}")
            ->setFitToWidth(1)
            ->setFitToHeight(50)
            ->setOrientation(PageSetup::ORIENTATION_LANDSCAPE);

        $this->sheet->getPageMargins()
            ->setTop(0.5)
            ->setBottom(0.17)
            ->setRight(0.17)
            ->setLeft(0.17);
        
        $this->sheet->setAutoFilter("A1:{$this->last_column}{$this->rows}");

        return $this;
    }

    protected function formatHeaders()
    {
        $this->sheet->getStyle("A1:{$this->last_column}2")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'C9C9C9',
                ]
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'font' => [
                'bold' => true,
            ]
        ]);
        
        $this->sheet->getStyle("A1:{$this->last_column}{$this->rows}")
            ->getAlignment()
                ->setHorizontal(Alignment::HORIZONTAL_CENTER)
                ->setVertical(Alignment::VERTICAL_CENTER)
                ->setWrapText(true);
        
        $this->sheet->freezePane('B3');

        return $this;
    }

    protected function formatSubHeaders()
    {
        $this->sheet->getStyle("A2:{$this->last_column}2")->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'color' => [
                    'rgb' => 'DBDBDB',
                ]
            ],
            'borders' => [
                'top' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ]
            ],
            'font' => [
                'bold' => true,
            ]
        ]);

        return $this;
    }

    protected function mergeCells()
    {
        $this->sheet
            ->mergeCells("A1:A2")
            ->mergeCells("B1:B2")
            ->mergeCells("C1:C2")
            ->mergeCells("D1:D2")
            ->mergeCells("E1:E2")
            ->mergeCells("F1:F2")
            ->mergeCells("G1:I1")
            ->mergeCells("J1:J2")
            ->mergeCells("K1:L1")
            ->mergeCells("M1:N1")
            ->mergeCells("O1:Q1")
            ->mergeCells("R1:T1")
            ;

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

        foreach (range("A", "F") as $col) {
            $this->sheet
            ->getStyle("{$col}1:{$col}{$this->rows}")->applyFromArray($format);
        }

        $this->sheet->getStyle("I1:I{$this->rows}")->applyFromArray($format);
        $this->sheet->getStyle("J1:J{$this->rows}")->applyFromArray($format);
        $this->sheet->getStyle("L1:L{$this->rows}")->applyFromArray($format);
        $this->sheet->getStyle("N1:N{$this->rows}")->applyFromArray($format);
        $this->sheet->getStyle("Q1:Q{$this->rows}")->applyFromArray($format);
        $this->sheet->getStyle("T1:T{$this->rows}")->applyFromArray($format);
            

        return $this;
    }
    
    protected function applySpecialFormats()
    {
        $this->sheet->getStyle("B1:B{$this->rows}")
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_DDMMYYYY);
        
        $this->sheet->getStyle("E1:F{$this->rows}")
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);

        $this->sheet->getStyle("M1:N{$this->rows}")
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_PERCENTAGE_00);
        
        $this->sheet->getStyle("J1:L{$this->rows}")
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_CURRENCY_USD);
        
        $this->sheet->getStyle("O1:T{$this->rows}")
            ->getNumberFormat()
            ->setFormatCode(NumberFormat::FORMAT_DATE_TIME4);
        
        return $this;
    }

    protected function applyConditionalFormats()
    {
        $conditional1 = new Conditional();
        $conditional1->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional1->setOperatorType(Conditional::OPERATOR_EQUAL);
        $conditional1->addCondition(0);
        $conditional1->getStyle()->getFont()->getColor()->setARGB(
            Color::COLOR_WHITE
        );
        $conditionalStyles = $this->sheet->getStyle("A3:T{$this->rows}")->getConditionalStyles();
        $conditionalStyles[] = $conditional1;

        $this->sheet->getStyle("A3:T{$this->rows}")->setConditionalStyles($conditionalStyles);
    }
}
