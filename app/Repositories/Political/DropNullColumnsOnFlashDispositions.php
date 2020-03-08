<?php

namespace App\Repositories\Political;

use Illuminate\Support\Arr;

class DropNullColumnsOnFlashDispositions
{
    
    public $data = [];

    public $keys = [];

    public function handle($data)
    {
        $this->data = array_map(function($item) {
            $return_data = [];

            foreach ($item as $key => $value) {
                if ($value !== null) {
                    $this->addValidKeys($key, $value);
                    $return_data[$key] = $value;
                }
            }
            
            return $return_data;
        }, $data);

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
        $this->data = array_map(function($item) use ($set_last_key) {    
                    $array = array_merge($this->keys, $item);

                    if ($set_last_key) {
                        $element = Arr::get($array, $set_last_key);
                        Arr::forget($array, $set_last_key);
                        $array =  Arr::add($array, $set_last_key, $element);
                    }
                    
                    return $array;
        }, $this->data);

        return $this;
    }

    /**
     * Create an array of all valid keys present in the collection
     *
     * @param String $key
     * @param Array $value
     * @return void
     */
    private function addValidKeys($key, $value) 
    {               
        if (! in_array($key, $this->keys)) {
            return $this->keys[$key] = null;
        }

        return $this;
    }

}

