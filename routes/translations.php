<?php

use Illuminate\Support\Facades\Route;
use IsaEken\LaravelTranslator\Http\Controllers\LocaleController;
use IsaEken\LaravelTranslator\Http\Middleware\Localization;

Route::middleware(Localization::class)->prefix('/api/translator')->group(function () {
    Route::get('/', [LocaleController::class, 'locale',])->name('api.translator.locale');
});
