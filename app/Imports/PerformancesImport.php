<?php

namespace App\Imports;

use App\User;
use Carbon\Carbon;
use App\Performance;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;

class PerformancesImport implements ToCollection, WithHeadingRow, WithValidation, WithMapping
{
    use Importable;

    public function collection(Collection $rows)
    {
        foreach($rows as $row) {

            Validator::make(
                $row->all(), $this->rules()
            )->validate();

            Performance::removeExisting($row['unique_id'])
                ->create($row->all());
        }
    }

    public function rules(): array
    {
        return [
            'unique_id' => 'required',
            'date' => 'required|date',
            'employee_id' => 'required|exists:employees,id',
            'name' => 'required',
            'campaign_id' => 'required|exists:campaigns,id',
            'supervisor_id' => 'required|exists:supervisors,id',
            'sph_goal' => 'required|numeric',
            'login_time' => 'required|numeric',
            'production_time' => 'required|numeric',
            'talk_time' => 'required|numeric',
            'billable_hours' => 'required|numeric',
            'contacts' => 'required|numeric',
            'calls' => 'required|numeric',
            'transactions' => 'required|numeric',
            'revenue' => 'required|numeric'
        ];
    }

    /**
     * Convert an date in a carbon instance
     *
     * @param  value $value the value to be parsed
     * @param  format    $format the format from where the carbon instance is created
     * @return Carbon instance
     */
    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(
                \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
            );
        } catch (\ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }

    public function map($row): array
    {
        return [
                'unique_id' => $row['unique_id'],
                'date' => $this->transformDate($row['date'])->format('Y-m-d'),
                'employee_id' => $row['employee_id'],
                'name' => $row['employee_name'],
                'campaign_id' => $row['campaign_id'],
                'supervisor_id' => $row['supervisor_id'],
                'sph_goal' => $row['sph_goal'],
                'login_time' => $row['login_time_parsed'],
                'production_time' => $row['production_time_parsed'],
                'talk_time' => $row['talk_time_parsed'],
                'billable_hours' => $row['billable_hours'],
                'contacts' => $row['contacts'],
                'calls' => $row['calls'],
                'transactions' => $row['transactions'],
                'revenue' => $row['revenue']
            ];
    }
}
