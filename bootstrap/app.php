<?php

use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\BuyerMiddleware;
use App\Http\Middleware\orMiddleware;
use App\Http\Middleware\SellerMiddleware;
use App\Http\Middleware\SuperadminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->redirectGuestsTo(fn(Request $request) => route('auth'));
        $middleware->redirectUsersTo(fn(Request $request) => route('dashboard.index'));

        $middleware->alias([
            'superadmin' => SuperadminMiddleware::class,
            'admin' => AdminMiddleware::class,
            'seller' => SellerMiddleware::class,
            'buyer' => BuyerMiddleware::class,
            'or' => orMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
