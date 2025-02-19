<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth',
    'as' => 'auth.',
    'middleware' => ['guest'],
], function () {
    //
});

Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
], function () {
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
