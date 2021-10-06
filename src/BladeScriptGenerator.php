<?php

namespace IsaEken\LaravelTranslator;

class BladeScriptGenerator
{
    public function __invoke(): string
    {
        $translations = json_encode(app('translator')->all());

        return <<<HTML
<script type="text/javascript">
    const translations = $translations;
    window.translations = translations;

    /**
     * Replace translation string.
     *
     * @param {string} string
     * @param {object} replace
     * @returns {string}
     */
    function __replace(string, replace) {
        Object.entries(replace).forEach(([key, value]) => {
            string = string.replace(':' + key, value);
        });

        return string;
    }

    /**
     * Get translated string.
     *
     * @param {string} key
     * @param {object} replace
     * @returns {string}
     */
    function __(key, replace = []) {
        if (!window['translations'].hasOwnProperty(key)) {
            return __replace(key, replace);
        }

        return __replace(window['translations'][key], replace);
    }

    window.__ = __;
</script>
HTML;
    }
}
