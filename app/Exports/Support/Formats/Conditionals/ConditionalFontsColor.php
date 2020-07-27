<?php

namespace App\Exports\Support\Formats\Conditionals;

use PhpOffice\PhpSpreadsheet\Style\Conditional;

class ConditionalFontsColor
{
    public static function apply(
        $sheet,
        string $range,
        int $condition = 0,
        string $operator = 'equal',
        string $color = 'FFFFFFFF'
    ) {
        $conditional1 = new Conditional();
        $conditional1->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional1->setOperatorType($operator);
        $conditional1->addCondition($condition);
        $conditional1->getStyle()->getFont()->getColor()->setARGB($color);
        $conditionalStyles = $sheet->getStyle($range)
            ->getConditionalStyles();
        $conditionalStyles[] = $conditional1;

        $sheet->getStyle($range)
            ->setConditionalStyles($conditionalStyles);
    }
}
