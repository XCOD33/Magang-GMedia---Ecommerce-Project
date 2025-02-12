<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "Home " . session('error') ?? '';
});

Route::group([
    'middleware' => 'superadmin',
    'as' => 'superadmin.',
    'prefix' => 'superadmin',
], function () {
    // middleware superadmin
});

Route::group([
    'middleware' => 'seller',
    'as' => 'seller.',
    'prefix' => 'seller',
], function () {
    // middleware seller
});
