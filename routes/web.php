<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => AuthController::class,
    'middleware' => ['guest'],
], function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login')->name('login.post');
});

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth'],
], function () {
    Route::get('/', function () {
        return 'Dashboard';
    })->name('index');

    Route::group([
        'prefix' => 'data-master',
        'as' => 'data-master.',
        'middleware' => ['auth', 'superadmin'],
    ], function () {
        //
    });

    Route::group([
        'prefix' => 'seller',
        'as' => 'seller.',
        'middleware' => ['auth', 'seller'],
    ], function () {
        //
    });
});
