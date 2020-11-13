<?php

namespace App\Exports\Support\Formats;

use PhpOffice\PhpSpreadsheet\Style\Border;

class Backgrounds
{
    public static function apply(
        $sheet,
        string $range,
        string $type = 'solid',
        string $color = '000000'
    ) {
        $sheet->getStyle($range)->applyFromArray([
            'fill' => [
                'fillType' => $type,
                'color' => [
                    'rgb' => $color,
                ]
            ]
        ]);
    }
}
