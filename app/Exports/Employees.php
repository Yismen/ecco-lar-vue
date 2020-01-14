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
                'site', 'project', 'position', 'bankAccount', 'termination'
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
            optional(optional($employee->position)->department)->name,
            optional($employee->supervisor)->name,
            optional($employee->position)->salary,
            optional($employee->position)->pay_per_hours,
            optional($employee->bankAccount)->account_number,
            $employee->status,
            $employee->termination ? Date::dateTimeToExcel( $employee->termination->termination_date) : '',
            optional(optional($employee->termination)->terminationType)->name
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
            'V' => NumberFormat::FORMAT_NUMBER,
            'W' => NumberFormat::FORMAT_NUMBER,
            'X' => NumberFormat::FORMAT_NUMBER,
            'Z' => NumberFormat::FORMAT_DATE_XLSX15,
        ];
    }

    public function headings(): array
    {
        return [
            'Employee ID',
            'Full Name',
            'First Name',
            'Second First Name',
            'Last Name',
            'Second Last name',
            'Punch ID',
            'Personal ID or Passport',
            'Hire Date',
            'Date of Birth',
            'Phone Area',
            'Phone Number',
            'Address',
            'Gender',
            'Relationship',
            'Nationality',
            'Site',
            'Project',
            'Position',
            'Department',
            'Supervisor',
            'Salary',
            'Hourly Pay',
            'Account Number',
            'Status',
            'Termination Date',
            'Termination Type',
        ];
    }
}
