<?php

/** @var \Illuminate\Validation\Factory $validator */
// $validator = new Validator;
Validator::extend(
    'valid_password',
    function ($attribute, $value, $parameters)
    {
        return preg_match('/^[a-zA-Z0-9!@#$%\/\^&\*\(\)\-_\+\=\|\[\]{}\\\\?\.,<>`\'":;]+$/u', $value);
    }
);

Validator::extend(
    'phone_number',
    function ($attribute, $value, $parameters)
    {
        return strlen(preg_replace('#^.*([0-9]{3})[^0-9]*([0-9]{3})[^0-9]*([0-9]{4})$#', '$1$2$3', $value)) == 10;
    }
);

Validator::extend('alpha_space', function($attribute, $value)
        {
         return preg_match('/^[\pL\s]+$/u', $value);
        });

Validator::extend('alpha_dash_space', function($attribute, $value)
        {
         return preg_match('/^[\pL\s_-]+$/u', $value);
        });

Validator::extend('alpha_space_number', function($attribute, $value)
        {
         return preg_match('/^[\pL\pN\s]+$/u', $value);
        });

Validator::extend('alpha_dash_space_number', function($attribute, $value)
        {
         return preg_match('/^[\pL\pN\s-_]+$/u', $value);
        });