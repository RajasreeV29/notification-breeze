<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
   
    public function handle(Request $request, Closure $next): Response
    {
        // dd(Session::get('locale'));
       $locale = Session::get('locale', config('app.locale'));
        App::setLocale($locale);
        return $next($request);
    }
}
