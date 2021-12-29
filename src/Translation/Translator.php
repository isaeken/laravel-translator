<?php

namespace IsaEken\LaravelTranslator\Translation;

use IsaEken\LaravelTranslator\Exceptions\TranslationNotExistsException;

class Translator extends \Illuminate\Translation\Translator
{
    /**
     * Get all translations.
     *
     * @param string|null $locale
     *
     * @return array
     */
    public function all(string|null $locale = null): array
    {
        if ($locale === null) {
            $locale = $this->locale;
        }

        $translations = [];

        if (file_exists($path = resource_path('lang/' . $this->fallback . '.json'))) {
            $translations = @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? [];
        }

        if (file_exists($path = resource_path('lang/' . $locale . '.json'))) {
            array_merge($translations, @json_decode(file_get_contents($path), true, flags: JSON_UNESCAPED_UNICODE) ?? []);
        }

        return $translations;
    }

    /**
     * Save translation.
     *
     * @param string $key
     * @param string $translation
     * @param string $locale
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

            if (! array_key_exists($key, $translations)) {
                $translations[$key] = $translation;
                file_put_contents($path, json_encode($translations, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
            }
        }
    }

    /**
     * Determine if a translation exists.
     *
     * @param string $key
     * @param string|null $locale
     * @param bool $fallback
     * @return bool
     */
    public function has($key, $locale = null, $fallback = true): bool
    {
        return $this->baseGet($key, [], $locale, $fallback) !== $key;
    }

    /**
     * Get the translation for the given key.
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @param bool $fallback
     * @return string|array
     */
    public function baseGet(string $key, array $replace = [], string|null $locale = null, bool $fallback = true): string|array
    {
        $locale = $locale ?: $this->locale;
        $this->load('*', '*', $locale);
        $line = $this->loaded['*']['*'][$locale][$key] ?? null;

        if (! isset($line)) {
            [$namespace, $group, $item] = $this->parseKey($key);
            $locales = $fallback ? $this->localeArray($locale) : [$locale];

            foreach ($locales as $locale) {
                if (! is_null($line = $this->getLine($namespace, $group, $locale, $item, $replace))) {
                    return $line;
                }
            }
        }

        return $this->makeReplacements($line ?: $key, $replace);
    }

    /**
     * Get the translation for the given key.
     *
     * @param string $key
     * @param array $replace
     * @param string|null $locale
     * @param bool $fallback
     *
     * @return string|array
     */
    public function get($key, array $replace = [], $locale = null, $fallback = true): array|string
    {
        $locale = $locale ?: $this->locale;

        if (config('translator.throw_undefined', false) === true) {
            throw_unless($this->has($key, $locale, false), TranslationNotExistsException::class, $key, $locale);
        }

        if (config('translator.autosave', false) === true) {
            $this->load('*', '*', $locale);

            if (! $this->has($key, $locale, false)) {
                $this->add($key, $key, $locale);
            }
        }

        return parent::get($key, $replace, $locale, $fallback);
    }
}
