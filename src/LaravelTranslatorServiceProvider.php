<?php

namespace IsaEken\LaravelTranslator;

use Facade\IgnitionContracts\SolutionProviderRepository;
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
            ->hasRoute('api')
            ->hasConfigFile();
    }

    public function packageBooted()
    {
        if ($this->app->environment() === 'local') {
            $this->app
                ->make(SolutionProviderRepository::class)
                ->registerSolutionProvider(TranslationSolutionProvider::class);
        }

        $this->app->extend('translator', function (\Illuminate\Translation\Translator $translator) {
            return new Translator($translator->getLoader(), $translator->getLocale());
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
