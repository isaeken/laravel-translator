<?php

namespace IsaEken\LaravelTranslator\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use IsaEken\LaravelTranslator\LaravelTranslator;

class LocaleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function locale(): JsonResponse
    {
        return response()->json([
            'locale'       => $locale = app()->getLocale(),
            'fallback'     => app('translator')->getFallback(),
            'is_supported' => LaravelTranslator::isSupported($locale),
            'locales'      => LaravelTranslator::getLocales(),
            'translations' => LaravelTranslator::getTranslations(),
        ], options: app()->environment() !== 'production' ? JSON_PRETTY_PRINT : null);
    }
}
