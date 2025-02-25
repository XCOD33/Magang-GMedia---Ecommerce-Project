<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

/**
 * Memuat semua file rute API yang ada di direktori 'api'.
 * Fungsi ini akan melakukan iterasi melalui setiap file dalam direktori
 * dan memuatnya menggunakan `require`.
 */
Route::group([
    'as' => 'api.',
], function () {
    $files = File::files(__DIR__ . '/api');
    foreach ($files as $file) {
        require $file->getPathname();
    }
});
