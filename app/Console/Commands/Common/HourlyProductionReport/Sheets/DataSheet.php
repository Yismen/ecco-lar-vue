<?php

namespace App\Console\Commands\Common\HourlyProductionReport\Sheets;

use App\Exports\RangeFormarter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class DataSheet implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $data;

    protected $sheet;
    
    protected $rows;
    protected $last_column;

    protected $sheetName;

    protected $title;

    public function __construct(array $data, $sheetName, $title)
    {
        $this->data = $data;

        $this->rows = count($this->data) + 2;
        $this->last_column = "P";
        $this->sheetName = $sheetName;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('exports.data', [
            'data' => $this->data,
            'dataTitle' => $this->title,
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $totalsRow = $this->rows + 1;
                
                // auto
                $this->sheet = $event->sheet->getDelegate();

                
                (new RangeFormarter($event, "A1:{$this->last_column}{$this->rows}"))
                    ->configurePage()
                    ->setColumnsWidth("B", "E")
                    ->formatTitle("A1:D1")
                    ->formatHeaderRow("A2:{$this->last_column}2")
                    ->applyBorders("A3:{$this->last_column}{$this->rows}")
                    ->applyNumberFormats("F3:H{$totalsRow}", '#,##0.00')
                    ->applyNumberFormats("L3:L{$totalsRow}", '#,##0.00')
                    ->applyNumberFormats("M3:{$this->last_column}{$totalsRow}", NumberFormat::FORMAT_PERCENTAGE_00)
                    ->formatTotals("F{$totalsRow}:P{$totalsRow}")
                ;
   
                $this->addSubTotals();

                $this->sheet->freezePane('D3');
                
                $this->sheet->setAutoFilter("A2:{$this->last_column}{$this->rows}");

                // Adjust DialGroup column width
                $this->sheet->getColumnDimension('A')->setWidth(10);
            }
        ];
    }

    public function title(): string
    {
        return $this->sheetName;
    }

    protected function addSubTotals()
    {
        $totalsRow = ($this->rows + 1);
        $loginTimeColumn = 'F';
        $workTimeColumn = 'G';
        $talkTimeColumn = 'H';
        $callsColumn = 'I';
        $salesColumn = 'J';
        $contactsColumn = 'K';


        foreach (range($loginTimeColumn, $contactsColumn) as $letter) {
            $this->sheet->setCellValue(
                "{$letter}{$totalsRow}",
                "=SUBTOTAL(9, {$letter}3:{$letter}{$this->rows})"
            );
        }

        // SPH Rate
        $this->sheet->setCellValue(
            "L{$totalsRow}",
            "=IFERROR({$salesColumn}{$totalsRow}/{$workTimeColumn}{$totalsRow},0)"
        );

        // Conversion Rate
        $this->sheet->setCellValue(
            "M{$totalsRow}",
            "=IFERROR({$salesColumn}{$totalsRow}/{$contactsColumn}{$totalsRow},0)"
        );

        // Contact Rate
        $this->sheet->setCellValue(
            "N{$totalsRow}",
            "=IFERROR({$contactsColumn}{$totalsRow}/{$callsColumn}{$totalsRow},0)"
        );

        // Hours Efficiency Rate
        $this->sheet->setCellValue(
            "O{$totalsRow}",
            "=IFERROR({$workTimeColumn}{$totalsRow}/{$loginTimeColumn}{$totalsRow},0)"
        );

        // Talk Time Rate
        $this->sheet->setCellValue(
            "P{$totalsRow}",
            "=IFERROR({$talkTimeColumn}{$totalsRow}/{$workTimeColumn}{$totalsRow},0)"
        );
    }
}
