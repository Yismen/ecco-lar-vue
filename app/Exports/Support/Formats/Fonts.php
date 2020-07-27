<?php

namespace App\Exports\Support\Formats;

use PhpOffice\PhpSpreadsheet\Style\Border;

class Fonts
{
    public static function apply(
        $sheet,
        string $range,
        bool $bold = false,
        string $color = '000000',
        $verticalAlightment = 'center',
        $horizontalAlightment = 'center'
    ) {
        $sheet->getStyle($range)->applyFromArray([
            'font' => [
                'bold' => $bold,
                'size' => 8,
                'color' => [
                    'rgb' => $color
                ],
                'alightment' => [
                    'horizontal' => $horizontalAlightment,
                    'vertical' => $verticalAlightment,
                ]
            ]
        ]);
    }
}
