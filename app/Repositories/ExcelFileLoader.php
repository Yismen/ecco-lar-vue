<?php

namespace App\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExcelFileLoader
{
    /**
     * Data upload from files
     * @var array
     */
    private $data = [];

    /**
     * Validation errors found on the file
     * @var array
     */
    private $errors = [];

    /**
     * rules to validate each line of data.
     * @var array
     */
    private $validation_rules = [];

    public function __construct($rules)
    {
        $this->validation_rules = $rules;
    }

    public function load($files)
    {
        foreach ($files as $file) {
            Excel::load($file, function($reader) {
                foreach($reader->toArray() as $data){
                    $this->handleRow($reader, $data);
                }
            });
        }

        return $this;
            
    }

    public function data()
    {
        return $this->data;
    }

    public function errors()
    {
        return $this->errors;
    }

    public function hasErrors()
    {
        if (count($this->errors) > 0) {
            return true;
        }
        return false;
    }

    public function handleRow($reader, $data)
    {
        $validator = Validator::make($data, $this->validation_rules);

        if ($validator->fails()) {
            $messages = $validator->messages()->getMessages();
            $field_with_error = array_keys($messages);
            $data = $validator->getData();

            $this->errors[
                explode(".", $reader->file->getClientOriginalName())[0]
            ][] = [
                'data' => $data,
                'failed_field' => $field_with_error,
                'error_messages' => $messages,
            ];
        } else {
            $this->data[] = $data;
        }
    }
}