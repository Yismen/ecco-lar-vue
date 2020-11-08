<?php

namespace App\Imports;

use App\Notifications\UserAppNotification;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Events\AfterImport;
use Maatwebsite\Excel\Events\ImportFailed;

trait ExcelImportTrait
{
    public function chunkSize(): int
    {
        return 300;
    }

    public function batchSize(): int
    {
        return 300;
    }

    public function registerEvents(): array
    {
        return [
            AfterImport::class => function (AfterImport $event) {
                $this->importedBy->notify(new UserAppNotification(
                    "Data Imported Succesfully!",
                    "File {$this->file_name} was imported!",
                    'success'
                ));
            },
            ImportFailed::class => function (ImportFailed $event) {
                $this->importedBy->notify(new UserAppNotification(
                    "Import Failed!***",
                    $event->e->getMessage(),
                    'danger'
                ));
            },
        ];
    }

    /**
     * Convert an date in a carbon instance.
     *
     * @param value  $value  the value to be parsed
     * @param format $format the format from where the carbon instance is created
     *
     * @return Carbon instance
     */
    protected function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(
                \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value)
            );
        } catch (\ErrorException $e) {
            return Carbon::parse($value);
        }
    }
}
