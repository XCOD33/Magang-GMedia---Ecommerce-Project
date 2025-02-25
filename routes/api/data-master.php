<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'data-master',
    'as' => 'data-master.',
    'middleware' => ['jwt', 'role:admin']
], function () {
    require __DIR__ . '/product-category.php';
    // require route lainnya
});
