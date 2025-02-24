<?php

namespace App\Providers;

use App\Services\DataTableService;
use App\Services\SlugService;
use Illuminate\Support\Facades\View;
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

        /**
         * Registers the DataTableService as a singleton in the application's service container.
         * This allows the DataTableService to be injected and used throughout the application.
         */
        $this->app->singleton(DataTableService::class, function () {
            return new DataTableService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('pages.dashboard.*', function ($view) {
            $view->with('title', 'Dashboard');
            $view->with('authUserName', auth()->user()->name);
            $view->with('authUserRole', auth()->user()->role);
            $view->with('authUserEmail', auth()->user()->email);
        });
    }
}
