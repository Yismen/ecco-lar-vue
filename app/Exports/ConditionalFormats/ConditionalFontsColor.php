<?php

namespace App\Exports\ConditionalFormats;

use PhpOffice\PhpSpreadsheet\Style\Conditional;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ConditionalFontsColor implements ConditionalFormatsInterface
{
    /** Sheet object */
    public $sheet;
    /** condition to be met to apply the format */
    public $condition;
    /** The range to evaluate */
    public $range;
    public $operator;
    public $color;

    public function __construct(array $options)
    {
        $this->sheet = $options['sheet'];
        $this->range = $options['range'];
        $this->condition = $options['condition'] ?? 0;
        $this->operator = $options['operator'] ?? Conditional::OPERATOR_EQUAL;
        $this->color = $options['color'] ?? Color::COLOR_WHITE;
    }

    public function apply()
    {
        $conditional1 = new Conditional();
        $conditional1->setConditionType(Conditional::CONDITION_CELLIS);
        $conditional1->setOperatorType($this->operator);
        $conditional1->addCondition($this->condition);
        $conditional1->getStyle()->getFont()->getColor()->setARGB($this->color);
        $conditionalStyles = $this->sheet->getStyle($this->range)
            ->getConditionalStyles();
        $conditionalStyles[] = $conditional1;

        $this->sheet->getStyle($this->range)
            ->setConditionalStyles($conditionalStyles);
    }
}
