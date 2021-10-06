<?php

namespace IsaEken\LaravelTranslator\SolutionProviders;

use Facade\IgnitionContracts\HasSolutionsForThrowable;
use IsaEken\LaravelTranslator\Exceptions\TranslationNotExistsException;
use IsaEken\LaravelTranslator\Solutions\TranslationNotExistsSolution;
use JetBrains\PhpStorm\Pure;
use Throwable;

class TranslationSolutionProvider implements HasSolutionsForThrowable
{
    public function canSolve(Throwable $throwable): bool
    {
        return $throwable instanceof TranslationNotExistsException;
    }

    #[Pure] public function getSolutions(Throwable $throwable): array
    {
        return [
            new TranslationNotExistsSolution($throwable->translation, $throwable->locale),
        ];
    }
}
