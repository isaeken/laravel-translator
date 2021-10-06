<?php

namespace IsaEken\LaravelTranslator\Translation;

use IsaEken\LaravelTranslator\Exceptions\TranslationNotExistsException;

class Translator extends \Illuminate\Translation\Translator
{
    /**
     * @param  string  $key
     * @param  string  $translation
     * @param  string  $locale
     */
    public function add(string $key, string $translation, string $locale): void
    {
        $this->load('*', '*', $locale);

        if (! $this->has($key, $locale, false)) {
            $path = resource_path('lang/' . $locale . '.json');
            $translations = [];

            if (file_exists($path)) {
                $translations = @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? [];
            }

            if (!array_key_exists($key, $translations)) {
                $translations[$key] = $translation;
                file_put_contents($path, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        }
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
        if ($locale === null) {
            $locale = $this->locale;
        }

        if (config('translator.throw_undefined', false) === true) {
            throw_unless($this->has($key, $locale, false), TranslationNotExistsException::class, $key, $locale);
        }

        if (config('translator.autosave', false) === true) {
            $this->load('*', '*', $locale);

            if (! $this->has($key, $this->fallback, false)) {
                $this->add($key, $key, $this->fallback);
            }

            if (! $this->has($key, $locale, false)) {
                $this->add($key, $key, $locale);
            }
        }

        return parent::get($key, $replace, $locale, $fallback);
    }
}
