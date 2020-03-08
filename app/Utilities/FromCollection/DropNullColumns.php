<?php

namespace App\Utilities\FromCollection;

use Illuminate\Support\Arr;

class DropNullColumns
{
    
    public $data = [];

    public $keys = [];

    public function handle(array $data)
    {
        
        $this->data = collect($data)->map(function($item) {
            return collect($item)->map(function($item) {
                return collect($item)->reject(function($item, $key) {
                    $this->getValidKeys($key, $item);
                    return $item == null;
                });
            });
        });

        return $this;
    }   
    /**
     * Ensure all the elements contains keys that have at least one record
     * with valid value.
     *
     * @param string $set_last_key
     * @return void
     */
    public function padKeys(string $set_last_key = null)
    {
        $this->data = $this->data->map(function($item) use ($set_last_key) {
            return $item->map(function($item) use ($set_last_key) {
                $array = array_merge($this->keys, $item->all());

                if ($set_last_key) {
                    $element = Arr::get($array, $set_last_key);
                    Arr::forget($array, $set_last_key);
                    $array =  Arr::add($array, $set_last_key, $element);
                }
                
                return $array;
            });
        });

        return $this;
    }

    /**
     * Create an array of all valid keys present in the collection
     *
     * @param String $key
     * @param Array $item
     * @return void
     */
    private function getValidKeys($key, $item) 
    {               
        if (! in_array($key, $this->keys) && $item !== null) {
            return $this->keys[$key] = null;
        }
    }

}

