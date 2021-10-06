<?php

namespace IsaEken\LaravelTranslator\Solutions;

use Facade\IgnitionContracts\RunnableSolution;
use IsaEken\LaravelTranslator\Translation\Translator;
use JetBrains\PhpStorm\ArrayShape;

class TranslationNotExistsSolution implements RunnableSolution
{
    /**
     * @param  string|null  $translation
     * @param  string|null  $locale
     */
    public function __construct(public string|null $translation = null, public string|null $locale = null)
    {
        // ...
    }

    public function getSolutionTitle(): string
    {
        return 'Missing translations';
    }

    public function getSolutionDescription(): string
    {
        return '';
    }

    public function getDocumentationLinks(): array
    {
        return [];
    }

    public function getSolutionActionDescription(): string
    {
        if ($this->translation !== null && $this->locale !== null) {
            return "Add `$this->translation` to `$this->locale` translations.";
        }
        else if ($this->translation !== null) {
            return "Add `$this->translation` to your default locale.";
        }
        else if ($this->locale !== null) {
            return "Add requested translations to your `$this->locale`.";
        }

        return 'Missing translations.';
    }

    public function getRunButtonText(): string
    {
        return 'Add translation';
    }

    #[ArrayShape(['translation' => "null|string", 'locale' => "null|string"])] public function getRunParameters(): array
    {
        return [
            'translation' => $this->translation,
            'locale' => $this->locale,
        ];
    }

    public function run(array $parameters = [])
    {
        if (isset($parameters['translation']) && isset($parameters['locale'])) {
            /** @var Translator $translator */
            $translator = app('translator');
            $translator->add($parameters['translation'], $parameters['translation'], $parameters['locale']);
        }
    }
}
