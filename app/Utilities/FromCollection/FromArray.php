<?php

namespace App\Utilities\FromCollection;

class FromArray
{

    public $data_array = [];

    public $keys = [];

    public function __construct(array $data_array)
    {
        $this->data_array = $data_array;
    }

    public function parse()
    {
        $this->data_array = array_map(function ($item) {
            foreach ($item as $key => $value) {
                $return[] = array_filter($item, function ($elem) use ($key, $value) {
                    if (!in_array($key, $this->keys)) {
                        $this->keys[$key] = null;
                    }
                    return $elem !== null;
                });
            };

            return $return;
        }, $this->data_array);

        return $this;
    }

    public function mergeKeys()
    {
        $this->data_array = array_map(function ($item) {
            return array_merge($this->keys, $item[0]);
        }, $this->data_array);

        return $this;
    }
}
