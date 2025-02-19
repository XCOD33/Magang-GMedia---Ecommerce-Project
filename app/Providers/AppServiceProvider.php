<?php

namespace App\Providers;

use App\Services\SlugService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        /**
         * Registers the SlugService as a singleton in the application's service container.
         * This allows the SlugService to be injected and used throughout the application.
         */
        $this->app->singleton(SlugService::class, function () {
            return new SlugService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
