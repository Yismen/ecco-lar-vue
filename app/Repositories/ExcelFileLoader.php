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
        if (is_array($files)) {
            foreach ($files as $file) {
                $this->handleLoad($file);
            }
        } else {
            $this->handleLoad($files);
        }
        
        return $this;
            
    }

    private function handleLoad($file)
    {
        Excel::load($file, function($reader) {
            foreach($reader->toArray() as $index => $data){
                $this->handleRow($reader, $data, $index);
            }
        });
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

    private function handleRow($reader, $data, $index)
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
                'row_error' =>  $index + 2,
                'failed_field' => $field_with_error,
                'error_messages' => $messages,
            ];
        } else {
            $this->data[] = $data;
        }
    }
}