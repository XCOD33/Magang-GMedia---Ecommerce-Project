<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'controller' => AuthController::class,
], function () {
    // api/auth
    Route::group([
        'middleware' => ['guest'],
    ], function () {
        Route::post('/register', 'register')->name('register');
        Route::post('/login', 'login')->name('login');
    });

    // api/auth
    Route::group([
        'middleware' => 'jwt',
    ], function () {
        Route::get('/user', 'me')->name('user');
        Route::post('/refresh', 'refresh')->name('refresh');
        Route::post('/logout', 'logout')->name('logout');
    });
});
