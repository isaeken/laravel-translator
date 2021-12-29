<?php

namespace IsaEken\LaravelTranslator\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class ApiController extends Controller
{
    /**
     * Display the all translations in requested locale.
     *
     * @param string $locale
     * @return JsonResponse
     */
    public function index(string $locale): JsonResponse
    {
        app()->setLocale($locale);
        return response()->json(app('translator')->all());
    }
}
