<?php
// config for IsaEken/LaravelTranslator
return [
    /*
    |--------------------------------------------------------------------------
    | Enable in production
    |--------------------------------------------------------------------------
    |
    | Enable package in production environment.
    |
    */

    'production' => true,

    /*
    |--------------------------------------------------------------------------
    | Supported Languages
    |--------------------------------------------------------------------------
    |
    | List of supported languages.
    |
    */

    'supported_languages' => [
        'en' => 'English',
    ],

    /*
    |--------------------------------------------------------------------------
    | Auto save translations
    |--------------------------------------------------------------------------
    |
    | Auto-add unattached translations.
    |
    */

    'autosave' => false,

    /*
    |--------------------------------------------------------------------------
    | Throw error undefined
    |--------------------------------------------------------------------------
    |
    | throw an error when requesting a translation that hasn't been added.
    |
    */

    'throw_undefined' => false,
];
