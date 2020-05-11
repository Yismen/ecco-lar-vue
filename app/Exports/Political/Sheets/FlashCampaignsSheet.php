<?php

namespace App\Exports\Political\Sheets;

use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class FlashCampaignsSheet implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $sheet;
    
    protected $rowsDispo;
    protected $rowsAnswers;

    protected $dispositions;

    protected $answers;

    protected $campaign;

    protected $answersLastColumn;

    public function __construct($dispositions, $answers, $campaign)
    {
        $this->rowsDispo = count($dispositions) + 3;
        $this->rowsAnswers = count($answers);

        $this->dispositions = $dispositions ;
        $this->answers = $answers;
        $this->campaign = $campaign;
        $this->answersLastColumn = $this->answersLastColumn();
    }

    public function view(): View
    {
        return view('exports.political.campaigns', [
            'dispositions' => $this->dispositions,
            'answers' => $this->answers,
            'campaign' => $this->campaign
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
                    
                $this->sheet->freezePane('A2');
                $this->sheet->getStyle("A3:B{$this->rowsDispo}")->applyFromArray([
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

                $this->sheet->getStyle("A{$this->answersStart()}:{$this->answersLastColumn}{$this->answersEnd()}")->applyFromArray([
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
        return substr($this->campaign, -28);
    }

    protected function answersStart()
    {
        return array_sum([$this->rowsDispo, 3]);
    }

    protected function answersEnd()
    {
        return array_sum([$this->answersStart(), $this->rowsAnswers, -1]);
    }

    protected function answersLastColumn()
    {
        $range = range('A', 'ZZ');

        $col = collect($this->answers)->first();

        try {
            return $range[count(array_keys($col)) - 6];
        } catch (\Throwable $th) {
            return $range[count(array_keys($col)) - 7];
        }
    }

    protected function setColumnsWidth()
    {
        $this->sheet->getDefaultColumnDimension()->setWidth(8.25);
        foreach (range('A', $this->answersLastColumn) as $col) {
            $this->sheet->getColumnDimension($col)
                ->setAutoSize(true);
        }

        return $this;
    }

    protected function configurePage()
    {
        $this->sheet->getPageSetup()
            ->setPrintArea("A1:K{$this->rowsDispo}")
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
