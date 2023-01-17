<?php

use App\Rules\INN;
use App\Rules\SNILS;
use App\Rules\OGRN;

if ( !function_exists('validate_organization')) {
    function validate_organization (array $data)
    {
        $rules = [
            'name' => ['required', 'min:2', 'max:255', 'string', 'unique:organizations,name'],
            'ogrn' => ['required', 'string', 'digits:13', 'unique:organizations,ogrn', new OGRN()],
            'oktmo' => ['required', 'string', 'digits:11']
        ];

        return validator($data, $rules)->validate();
    }
}

if ( !function_exists('validate_user')) {
    function validate_user (array $data)
    {
        $rules = [
            'surname' => ['required', 'string', 'min:2', 'max:255'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
            'patronymic' => ['required', 'string', 'min:2', 'max:255'],
            'birthdate' => ['nullable', 'string', 'date', 'before:today'],
            'inn' => ['required', 'string', 'digits:12' , 'unique:users,inn', new INN()],
            'snils' => ['required', 'string', 'digits:11', 'unique:users,snils', new SNILS()], 
        ];

        return validator($data, $rules)->validate();
    }
}