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
     * : View.
     *
     * @return Excel file
     */
    public function query()
    {
        $status = $this->scope;

        return Employee::query()
            ->orderBy('first_name')
            ->with([
                'punch', 'address', 'gender', 'marital', 'nationality',
                'site', 'project', 'position', 'bankAccount',
            ])
            ->$status();
    }

    public function title(): string
    {
        return 'Employees';
    }

    public function map($employee): array
    {
        return [
            $employee->id,
            $employee->full_name,
            $employee->first_name,
            $employee->second_first_name,
            $employee->last_name,
            $employee->second_last_name,
            optional($employee->punch)->punch,
            filled($employee->personal_id) ? $employee->personal_id : $employee->passport,
            Date::dateTimeToExcel($employee->hire_date),
            Date::dateTimeToExcel($employee->date_of_birth),
            substr($employee->cellphone_number, 0, 3),
            substr($employee->cellphone_number, -7),
            null == $employee->address ? '' :
                $employee->address->street_address.', '.$employee->address->sector.', '.$employee->address->city,
            substr(optional($employee->gender)->name, 0, 1),
            optional($employee->marital)->name,
            optional($employee->nationality)->name,
            optional($employee->site)->name,
            optional($employee->project)->name,
            optional($employee->position)->name,
            optional($employee->position)->salary,
            optional($employee->bankAccount)->account_number,
        ];
    }

    public function columnFormats(): array
    {
        return [
            'I' => NumberFormat::FORMAT_DATE_XLSX15,
            'J' => NumberFormat::FORMAT_DATE_XLSX15,
            'G' => NumberFormat::FORMAT_TEXT,
            'H' => NumberFormat::FORMAT_TEXT,
            'K' => NumberFormat::FORMAT_TEXT,
            'L' => NumberFormat::FORMAT_TEXT,
            'U' => NumberFormat::FORMAT_NUMBER,
        ];
    }

    public function headings(): array
    {
        return [
            'id',
            'full_name',
            'first_name',
            'second_first_name',
            'last_name',
            'second_last_name',
            'punch',
            'personal_id or passport',
            'hire_date',
            'date_of_birth',
            'phone_area',
            'phone_number',
            'address',
            'gender',
            'relationship',
            'nationality',
            'site',
            'project',
            'position',
            'salary',
            'account_number',
        ];
    }
}
