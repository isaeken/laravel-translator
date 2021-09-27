<?php

namespace IsaEken\LaravelTranslator;

use Illuminate\Support\Facades\Facade;

/**
 * @see \IsaEken\LaravelTranslator\LaravelJsTranslations
 */
class LaravelTranslatorFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'laravel-translator';
    }
}
