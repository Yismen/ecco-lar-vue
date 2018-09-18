<?php

namespace App;

class Search
{
    private $TABLE; //the table to be searched
    private $FIELDS; //Array of fields to search in...

    // public function __construct($TABLE, $FIELDS)
    // {
    // 	$this->TABLE = $TABLE;
    // 	$this->FIELDS = $FIELDS;
    // }

    /**
     * perform a search query to the given model
     * @param  [model] $modelTable
     * @param  [array] $fields     array
     * @param  [string] $input      string
     * @return collection             collection of items meeting the chriteria
     */
    public function find($modelTable, $fields, $input = 'search')
    {
        foreach ($fields as $field) {
            $modelTable = $modelTable->orWhere($field, 'like', '%' . \Request::input($input) . '%');
        }

        return $modelTable->get();

        if (\Request::input($input)) {
            foreach ($fields as $field) {
                $modelTable = $modelTable->orWhere($field, 'like', '%' . \Request::input($input) . '%');
            }

            return $modelTable->get();
        }

        return $modelTable->get();
    }
}
