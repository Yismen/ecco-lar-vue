<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    "accepted"             => ":attribute debe ser aceptado.",
    "active_url"           => "El campo :attribute no es una URL válida.",
    "after"                => "El campo :attribute debe ser una fecha después de :date.",
    "alpha"                => "El campo :attribute sólo puede contener letras.",
    "alpha_dash"           => "El campo :attribute sólo puede contener letras, números y guiones.",
    "alpha_num"            => "El campo :attribute sólo puede contener letras y números.",
    "array"                => "El campo :attribute debe ser un arreglo.",
    "before"               => "El campo :attribute debe ser una fecha antes de :date.",
    "between"              => [
        "numeric" => "El campo :attribute debe estar entre :min y :max.",
        "file"    => "El campo :attribute debe estar entre :min y :max kilobytes.",
        "string"  => "El campo :attribute debe estar entre :min y :max caractéres.",
        "array"   => "El campo :attribute debe tener entre :min y :max elementos.",
    ],
    "boolean"              => "El campo :attribute debe ser verdadero o falso.",
    "confirmed"            => "El campo :attribute de confirmación no coincide.",
    "date"                 => "El campo :attribute no es una fecha válida.",
    "date_format"          => "El campo :attribute no coincide con el formato :format.",
    "different"            => "El campo :attribute y :other deben ser distintos.",
    "digits"               => "El campo :attribute debe tener :digits dígitos.",
    "digits_between"       => "El campo :attribute debe estar entre :min y :max dígitos.",
    "email"                => "El campo :attribute debe ser una dirección de correo válida.",
    "filled"               => "El campo :attribute es requerido.",
    "exists"               => "El campo :attribute seleccionado no es válido.",
    "image"                => "El campo :attribute debe ser una imagen.",
    "in"                   => "El campo :attribute seleccionado no es válido.",
    "integer"              => "El campo :attribute debe ser un entero.",
    "ip"                   => "El campo :attribute debe ser una dirección IP válida.",
    "max"                  => [
        "numeric" => "El campo :attribute no debe ser mayor que :max.",
        "file"    => "El campo :attribute no debe ser mayor que :max kilobytes.",
        "string"  => "El campo :attribute no debe ser mayor de :max caractéres.",
        "array"   => "El campo :attribute no debe tener más de :max elementos.",
    ],
    "mimes"                => "El campo :attribute debe ser un archivo de tipo: :values.",
    "min"                  => [
        "numeric" => "El campo :attribute debe ser al menos :min.",
        "file"    => "El campo :attribute debe tener al menos :min kilobytes.",
        "string"  => "El campo :attribute debe tener al menos :min caractéres.",
        "array"   => "El campo :attribute debe tener al menos :min elementos.",
    ],
    "not_in"               => "El campo :attribute seleccionado no es válido.",
    "numeric"              => "El campo :attribute debe ser un número.",
    "regex"                => "El formato del campo :attribute no es válido.",
    "required"             => "El campo :attribute es requerido.",
    "required_if"          => "El campo :attribute es requerido cuando :other es :value.",
    "required_with"        => "El campo :attribute es requerido cuando :values está presente.",
    "required_with_all"    => "El campo :attribute es requerido cuando :values está presente.",
    "required_without"     => "El campo :attribute es requerido cuando :values no está presente.",
    "required_without_all" => "El campo :attribute es requerido cuando ningún :values está presente.",
    "same"                 => "El campo :attribute y :other deben coincidir.",
    "size"                 => [
        "numeric" => "El campo :attribute debe tener :size.",
        "file"    => "El campo :attribute debe tener :size kilobytes.",
        "string"  => "El campo :attribute debe tener :size caractéres.",
        "array"   => "El campo :attribute debe contener :size elementos.",
    ],
    "unique"               => "El campo :attribute ya se encuentra en uso.",
    "url"                  => "El formato del campo :attribute no es válido.",
    "timezone"             => "El campo :attribute debe ser una región válida.",

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
