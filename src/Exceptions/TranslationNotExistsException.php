<?php

namespace IsaEken\LaravelTranslator\Exceptions;

use Exception;
use JetBrains\PhpStorm\Pure;
use Throwable;

class TranslationNotExistsException extends Exception
{
    #[Pure] public function __construct(public string|null $translation, public string|null $locale, Throwable $previous = null)
    {
        parent::__construct('', 0, $previous);
    }
}
