<?php

namespace IsaEken\LaravelTranslator;

use Facade\IgnitionContracts\SolutionProviderRepository;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\Compilers\BladeCompiler;
use IsaEken\LaravelTranslator\SolutionProviders\TranslationSolutionProvider;
use IsaEken\LaravelTranslator\Translation\Translator;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelTranslatorServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translator')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        $this->app
            ->make(SolutionProviderRepository::class)
            ->registerSolutionProvider(TranslationSolutionProvider::class);

        if (config('translator.production', true) === false && $this->app->environment() === 'production') {
            return;
        }

        if ($this->app->environment() !== 'production') {
            Artisan::call('view:clear');
        }

        $this->app->singleton('translator', function ($app) {
            $loader = $app['translation.loader'];
            $locale = $app['config']['app.locale'];
            $fallback = $app['config']['app.fallback_locale'];

            $translator = new Translator($loader, $locale);
            $translator->setFallback($fallback);
            return $translator;
        });

        if ($this->app->resolved('blade.compiler')) {
            /** @var BladeCompiler $bladeCompiler */
            $bladeCompiler = $this->app['blade.compiler'];

            $bladeCompiler->directive('translator', function () {
                return (new BladeScriptGenerator())->__invoke();
            });
        }
    }
}
