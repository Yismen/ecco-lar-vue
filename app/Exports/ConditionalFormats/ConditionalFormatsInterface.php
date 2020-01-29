<?php

namespace App\Exports\ConditionalFormats;


interface ConditionalFormatsInterface
{
    public function __construct(array $options);

    public function apply();
}