<?php

namespace IsaEken\LaravelTranslator;

use IsaEken\LaravelTranslator\Translation\Translator;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translator')
            ->hasConfigFile()
            ->hasRoute('translations');
    }

    public function packageBooted()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->singleton('translator', function ($app) {
                $loader = $app['translation.loader'];
                $locale = $app['config']['app.locale'];
                $fallback = $app['config']['app.fallback_locale'];

                $translator = new Translator($loader, $locale);
                $translator->setFallback($fallback);
                return $translator;
            });
        }
    }
}
