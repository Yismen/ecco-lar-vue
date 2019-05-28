<?php

namespace App\Exports;

use App\Employee;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;

class Employees implements FromQuery, WithTitle, ShouldAutoSize, WithColumnFormatting, WithMapping, WithHeadings
{
    protected $scope;

    public function __construct($scope)
    {
        $this->scope = $scope;
    }
    /**
     * : View
     *
     * @return Excel file
     */
    public function query()
    {
        $status = $this->scope;

        return Employee::query()
            ->orderBy('first_name')
            ->with('bankAccount')
            ->$status();
    }

    public function title(): string
    {
        return "Employees";
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->first_name,
            $employee->second_first_name,
            $employee->last_name,
            $employee->second_last_name,
            Date::dateTimeToExcel($employee->hire_date),
            $employee->personal_id,
            $employee->passport,
            $employee->cellphone_number,
            optional($employee->bankAccount)->account_number
        ];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_DATE_XLSX15,
            'G' => NumberFormat::FORMAT_TEXT,
            'J' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'first_name',
            'second_first_name',
            'last_name',
            'second_last_name',
            'hire_date',
            'personal_id',
            'passport',
            'cellphone_number',
            'account_number',
        ];
    }
}
