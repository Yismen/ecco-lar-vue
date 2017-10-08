<?php

namespace App\Repositories;

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;

class ExcelFileLoader
{
    private $data = [];

    private $errors = [];

    private $validation_rules = [];

    private $file_name_rules = [];

    public function __construct($rules)
    {
        // $this->file_name_rules = $file_name_rules;
        $this->validation_rules = $rules;
    }

    public function load($files)
    {
        foreach ($files as $file) {
            Excel::load($file, function($reader) {
                foreach($reader->toArray() as $data){

                    $validator = $this->validateRow($data);

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

    public function validateFileName($file, string $filename)
    {
        return Validator::make(
            [
                'file_name' => $file->getClientOriginalName()
            ], 
            [
                'file_name' => [
                    'required',
                    'regex:/(payroll_import)\w+/',
                ],
            ], [
                'regex' => 'No ha elegido el archivo correcto. Recuerde elegir un archivo de excel nombrado "payrol_import_##*"'
            ]
        );
    }

    public function validateRow($data)
    {
            return Validator::make($data, $this->validation_rules);
    }
}