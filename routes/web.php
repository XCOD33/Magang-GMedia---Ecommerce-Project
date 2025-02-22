<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::group([
    'controller' => AuthController::class,
    'middleware' => ['guest'],
], function () {
    Route::get('/auth', 'showAuthForm')->name('auth');
    Route::post('/login', 'login')->name('login');

    Route::post('/register', 'register')->name('register');
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
        'middleware' => ['superadmin'],
    ], function () {
        Route::group([
            'prefix' => 'user',
            'as' => 'user.',
            'controller' => UserController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::put('/update/{id}', 'update')->name('update');
            Route::delete('/delete/{id}', 'delete')->name('delete');
        });
    });

    Route::group([
        'prefix' => 'seller',
        'as' => 'seller.',
        'middleware' => ['seller'],
    ], function () {
        //
    });
});

Route::group([
    'prefix' => 'data-table',
    'as' => 'data-table.',
    'middleware' => ['auth'],
], function () {
    Route::get('/user', [UserController::class, 'dataTable'])->name('user');
});
