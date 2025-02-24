<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VoucherController;
use Illuminate\Support\Facades\Route;

// auth
Route::group([
    'controller' => AuthController::class,
], function () {
    Route::group([
        'middleware' => ['guest']
    ], function () {
        Route::get('/auth', 'showAuthForm')->name('auth');
        Route::post('/login', 'login')->name('login');

        Route::post('/register', 'register')->name('register');
    });

    Route::group([
        'middleware' => ['auth']
    ], function () {
        Route::post('/logout', 'logout')->name('logout');
    });
});

// dashboard
Route::group([
    'prefix' => 'dashboard',
    'as' => 'dashboard.',
    'middleware' => ['auth'],
], function () {
    // dashboard/index
    Route::get('/', function () {
        return 'Dashboard';
    })->name('index');

    // dashboard/data-master
    Route::group([
        'prefix' => 'data-master',
        'as' => 'data-master.',
        'middleware' => ['superadmin'],
    ], function () {
        // dashboard/data-master/user
        Route::group([
            'prefix' => 'user',
            'as' => 'user.',
            'controller' => UserController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('delete');
        });

        // dashboard/data-master/store
        Route::group([
            'prefix' => 'store',
            'as' => 'store.',
            'controller' => StoreController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('delete');
        });

        // dashboard/data-master/product-category
        Route::group([
            'prefix' => 'product-category',
            'as' => 'product-category.',
            'controller' => ProductCategoryController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('delete');
        });

        // dashboard/data-master/voucher
        Route::group([
            'prefix' => 'voucher',
            'as' => 'voucher.',
            'controller' => VoucherController::class,
        ], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create', 'create')->name('create');
            Route::post('/store', 'store')->name('store');
            Route::get('/edit/{id}', 'edit')->name('edit');
            Route::post('/update/{id}', 'update')->name('update');
            Route::post('/delete/{id}', 'destroy')->name('delete');
        });
    });

    // dashboard/seller
    Route::group([
        'prefix' => 'seller',
        'as' => 'seller.',
        'middleware' => ['seller'],
    ], function () {
        //
    });
});

// data-table
Route::group([
    'prefix' => 'data-table',
    'as' => 'data-table.',
    'middleware' => ['auth'],
], function () {
    Route::get('/user', [UserController::class, 'dataTable'])->name('user');
    Route::get('/store', [StoreController::class, 'dataTable'])->name('store');
    Route::get('/product-category', [ProductCategoryController::class, 'dataTable'])->name('product-category');
    Route::get('/voucher', [VoucherController::class, 'dataTable'])->name('voucher');
});

// category
Route::group([
    'prefix' => 'category',
    'as' => 'category.',
], function () {
    Route::get('/{slug}', function () {
        return 'Category';
    })->name('index');
});
