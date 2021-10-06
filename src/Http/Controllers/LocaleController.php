<?php

namespace IsaEken\LaravelTranslator\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use IsaEken\LaravelTranslator\Translation\Translator;

class LocaleController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function locale(): JsonResponse
    {
        /** @var Translator $translator */
        $translator = app('translator');

        return response()->json([
            'locale'       => $translator->getLocale(),
            'fallback'     => $translator->getFallback(),
            'translations' => $translator->all(),
        ], options: app()->environment() !== 'production' ? JSON_PRETTY_PRINT : null);
    }
}
