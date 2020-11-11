<?php

namespace App\Imports;

use App\PerformanceImport;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithEvents;

class PerformancesImport implements ToModel, WithHeadingRow, WithValidation, WithBatchInserts, WithEvents, WithChunkReading, ShouldQueue
{
    use Importable, ExcelImportTrait;

    protected $file_name;

    protected $importedBy;

    public function __construct($file_name)
    {
        $this->file_name = $file_name;

        $this->importedBy = auth()->user();
    }

    public function model(array $row)
    {
        PerformanceImport::where('unique_id', $row['unique_id'])->delete();
        
        return new PerformanceImport([
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
            'break_time' => $row['break_time_parsed'],
            'lunch_time' => $row['lunch_time_parsed'],
            'training_time' => $row['training_time_parsed'],
            'away_time' => $row['away_time_parsed'],
            'off_hook_time' => $row['off_hook_time_parsed'],
            'pending_dispo_time' => $row['pending_dispo_time_parsed'],
            'billable_hours' => $row['billable_hours'],
            'contacts' => $row['contacts'],
            'calls' => $row['calls'],
            'transactions' => $row['transactions'],
            'upsales' => $row['upsales'],
            'cc_sales' => $row['cc_sales'],
            'revenue' => $row['revenue'],
            'downtime_reason_id' => $row['reason_id'],
            'reported_by' => $row['reported_by'],
            'file_name' => $this->file_name,
        ]);
    }

    public function rules(): array
    {
        return [
            '*.unique_id' => 'required',
            '*.date' => 'required|date',
            '*.employee_id' => 'required|exists:employees,id',
            '*.employee_name' => 'required',
            '*.campaign_id' => 'required|exists:campaigns,id',
            '*.supervisor_id' => 'required|exists:supervisors,id',
            '*.sph_goal' => 'required|numeric',
            '*.login_time_parsed' => 'required|numeric',
            '*.production_time_parsed' => 'required|numeric',
            '*.talk_time_parsed' => 'numeric',
            '*.break_time_parsed' => 'numeric',
            '*.lunch_time_parsed' => 'numeric',
            '*.training_time_parsed' => 'numeric',
            '*.pending_dispo_time_parsed' => 'numeric',
            '*.off_hook_time_parsed' => 'numeric',
            '*.away_time_parsed' => 'numeric',
            '*.billable_hours' => 'required|numeric',
            '*.contacts' => 'required|numeric',
            '*.calls' => 'required|numeric',
            '*.transactions' => 'required|numeric',
            '*.upsales' => 'required|numeric',
            '*.cc_sales' => 'required|numeric',
            '*.revenue' => 'required|numeric',
            '*.downtime_reason_id' => 'nullable|exists:downtime_reasons,id',
        ];
    }
}
