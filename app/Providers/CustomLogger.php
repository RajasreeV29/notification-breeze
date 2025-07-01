<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CustomLoggerService;

class CustomLogger extends ServiceProvider
{
    /**
     * Register services.
     */
   public function register(): void
    {
        $this->app->singleton('customlogger', function ($app) {
            return new CustomLoggerService();
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
