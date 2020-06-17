<?php

namespace App\Exports\Wow\Sheets;

use App\Exports\RangeFormarter;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithPreCalculateFormulas;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class WowDataSheet implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
{
    protected $data;

    protected $sheet;
    
    protected $rows;
    protected $last_column;

    public function __construct(array $data)
    {
        $this->data = $data;

        $this->rows = count($this->data) + 2;
        $this->last_column = "O";
    }

    public function view(): View
    {
        return view('exports.wow.data', [
            'data' => $this->data
        ]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                
                // auto
                $this->sheet = $event->sheet->getDelegate();

                
                (new RangeFormarter($event, "A1:{$this->last_column}{$this->rows}"))
                    ->configurePage()
                    ->setColumnsWidth("A", "D")
                    ->formatTitle("A1:D1")
                    ->formatHeaderRow("A2:{$this->last_column}2")
                    ->applyBorders("A3:{$this->last_column}{$this->rows}")
                    ->applyNumberFormats("E3:G{$this->rows}", '#,##0.00')
                    ->applyNumberFormats("K3:K{$this->rows}", '#,##0.00')
                    ->applyNumberFormats("L3:{$this->last_column}{$this->rows}", NumberFormat::FORMAT_PERCENTAGE_00)
                ;
            }
        ];
    }

    public function title(): string
    {
        return "Report";
    }
}
