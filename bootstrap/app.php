<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\SetLocale;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Event;
use App\Events\CategoryEvent;
use App\Listeners\SendCategoryCreatedEmail;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        channels: __DIR__.'/../routes/channels.php',
        health: '/up',
    )
   ->withMiddleware(function (Middleware $middleware): void {
    $middleware->append(StartSession::class);     
    $middleware->append(SetLocale::class);   
})


    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();

Event::listen(CategoryEvent::class,[SendCategoryCreatedEmail::class, 'handle']
);  