<?php

use Illuminate\Support\Facades\Route;
use IsaEken\LaravelTranslator\Http\Controllers\ApiController;

Route::prefix('_translations/')->name('translator.')->group(function () {
    Route::get('/{locale}', [ApiController::class, 'index'])->name('index');
});
