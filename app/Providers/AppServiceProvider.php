<?php

namespace App\Providers;

use App\Services\DataTableService;
use App\Services\JsonResponseService;
use App\Services\ProductService;
use App\Services\SlugService;
use App\Services\ViewService;
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

        /**
         * Registers the JsonResponseService as a singleton in the application's service container.
         * This allows the JsonResponseService to be injected and used throughout the application.
         */
        $this->app->singleton(JsonResponseService::class, function () {
            return new JsonResponseService();
        });

        $this->app->singleton(ProductService::class, function () {
            return new ProductService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        View::composer('pages.dashboard.*', function ($view) {
            $viewService = app(ViewService::class);
            $pageInfo = $viewService->getPageInfo(request()->path());

            $view->with([
                'title' => $pageInfo['title'],
                'create_route' => $pageInfo['create_route'],
                'authUserName' => auth()->user()->name,
                'authUserRole' => auth()->user()->role,
                'authUserEmail' => auth()->user()->email
            ]);
        });
    }
}
