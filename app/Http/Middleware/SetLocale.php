<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Console\Application;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route as FacadesRoute;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $lang_available = config('app.locale_available') ?? ['es' => 'Español'];
        $lang = $request->route('locale') ?: Cookie::get('lang') ?: config('app.locale') ?: 'es';
        $lang = in_array($lang, array_keys($lang_available)) ? $lang : 'es';

        Cookie::forget('lang');
        Cookie::queue(Cookie::forever('lang', $lang));

        App::setLocale($lang);

        return $next($request);
    }
}
