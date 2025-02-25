<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'dashboard',
    'middleware' => 'jwt',
], function () {
    require __DIR__ . '/data-master.php';
});
