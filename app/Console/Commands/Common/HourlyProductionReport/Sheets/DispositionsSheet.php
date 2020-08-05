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

class DispositionsSheet implements FromView, WithTitle, WithEvents, WithPreCalculateFormulas
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
        $this->last_column = "F";
        $this->sheetName = $sheetName;
        $this->title = $title;
    }

    public function view(): View
    {
        return view('exports.dispositions', [
            'data' => $this->data,
            'dispositionsTitle' => $this->title,
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
                    ->setColumnsWidth("A", "C")
                    ->formatTitle("A1:D1")
                    ->formatHeaderRow("A2:{$this->last_column}2")
                    ->applyBorders("A3:{$this->last_column}{$this->rows}")
                    // ->applyNumberFormats("E2:G{$this->rows}", '#,##0.00')
                    ->applyNumberFormats("{$this->last_column}2:{$this->last_column}{$this->rows}", NumberFormat::FORMAT_PERCENTAGE_00)
                    ;
                    
                $this->sheet->setAutoFilter("A2:{$this->last_column}{$this->rows}");
            }
        ];
    }

    public function title(): string
    {
        return $this->sheetName;
    }
}
