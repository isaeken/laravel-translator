<?php

namespace IsaEken\LaravelTranslator\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if ($request->has('locale')) {
            app()->setLocale($request->get('locale'));
        }

        return $next($request);
    }
}
