<?php

namespace IsaEken\LaravelTranslator\Translation;

use IsaEken\LaravelTranslator\Exceptions\TranslationNotExistsException;

class Translator extends \Illuminate\Translation\Translator
{
    /**
     * Get or create the translation.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @param  bool  $fallback
     *
     * @return string|array
     */
    public function getOrNew(string $key, array $replace = [], string|null $locale = null, bool $fallback = true): string|array
    {
        $locale = $locale ?: $this->locale;
        $this->load('*', '*', $locale);

        if (!$this->has($key, $locale, false)) {
            $path = resource_path('lang/' . $this->fallback . '.json');
            $translations = [];

            if (file_exists($path)) {
                $translations = @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? [];
            }

            if (!array_key_exists($key, $translations)) {
                $translations[$key] = $key;
                file_put_contents($path, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        }

        return parent::get($key, $replace, $locale, $fallback);
    }

    /**
     * Get the translation for the given key.
     *
     * @param  string  $key
     * @param  array  $replace
     * @param  string|null  $locale
     * @param  bool  $fallback
     *
     * @return string|array
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true): array|string
    {
        if (config('translator.throw_undefined', false) === true) {
            throw_unless($this->has($key, $locale, false), TranslationNotExistsException::class, $key, $locale);
        }

        if (config('translator.autosave', false) === true) {
            return $this->getOrNew($key, $replace, $locale, $fallback);
        }

        return parent::get($key, $replace, $locale, $fallback);
    }
}
