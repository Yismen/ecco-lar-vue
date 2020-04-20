<?php

namespace App\Repositories\Dashboard;

class DataRepository
{
    protected $defaults = [];

    public function __construct(array $data = [], $label = 'Default Label')
    {
        $color = "rgba(1, 87, 155, 1)";
        
        $this->defaults = [
            "data" => $data,
            'borderColor' => 'rgba(1, 87, 155, 1)',
            'backgroundColor' => 'rgba(1, 87, 155, .25)',
            'label' => $label,
            'fill' => true
        ];
    }

    public function toArray(array $options = [])
    {
        return array_merge($this->defaults, $options);
    }
}
