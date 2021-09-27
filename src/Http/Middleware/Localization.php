<?php

namespace IsaEken\LaravelTranslator\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use IsaEken\LaravelTranslator\LaravelTranslator;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        $locale = $request->input('locale') ?? ($request->header('Content-Language') ?? config('app.locale'));

        if (config('translator.abort_if_unsupported')) {
            abort_unless(LaravelTranslator::isSupported($locale), 403, 'Unsupported language');
        }

        app()->setLocale($locale);
        $response = $next($request);
        $response->headers->set('Content-Language', $locale);
        return $response;
    }
}
