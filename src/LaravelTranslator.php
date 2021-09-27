<?php

namespace IsaEken\LaravelTranslator;

use Illuminate\Support\Traits\Macroable;
use Illuminate\Translation\Translator;

class LaravelTranslator
{
    use Macroable;

    public static function isSupported(string $locale): bool
    {
        return array_key_exists($locale, static::getLocales());
    }

    public static function getLocales(): array
    {
        return config('translator.supported_languages') ?? [];
    }

    public static function getTranslations(): array
    {
        /** @var Translator $translator */
        $translator = app('translator');
        $translations = [];

        if (file_exists($path = resource_path('lang/' . $translator->getFallback() . '.json'))) {
            $translations = @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? [];
        }

        if (file_exists($path = resource_path('lang/' . $translator->getLocale() . '.json'))) {
            array_merge(
                $translations,
                @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? []
            );
        }

        return $translations;
    }
}
