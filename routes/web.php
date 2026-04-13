<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/explore', function () {
    return view('explore');
});

Route::get('/authors', function () {
    return view('authors');
});

Route::get('/search', function () {
    return view('search');
});

Route::view('/changelog', 'changelog');

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login.store');
});

Route::get('/register', function () {
    return view('register');
})->name('register');

Route::post('/register', [RegisterController::class, 'store'])->name('register.store');

Route::middleware('auth')->group(function () {
    Route::middleware('role:super_admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard.index');
        })->name('dashboard');
    });

    Route::middleware('role:writer')->group(function () {
        Route::get('/writer', function () {
            return view('writer.index');
        })->name('writer.home');
    });

    Route::middleware('role:reader')->group(function () {
        Route::get('/reader', function () {
            return view('reader.index');
        })->name('reader.home');
    });
});

Route::get('/articles/{slug}', function (string $slug) {
    $pageTitle = Str::headline(str_replace('-', ' ', $slug));
    $tokens = preg_split('/\s+/', trim($pageTitle), -1, PREG_SPLIT_NO_EMPTY);
    $headlineLine1 = array_shift($tokens) ?: 'Raw';
    $headlineLine2 = $tokens ? implode(' ', $tokens) : 'Truths';

    return view('article', [
        'slug' => $slug,
        'pageTitle' => $pageTitle,
        'headlineLine1' => $headlineLine1,
        'headlineLine2' => $headlineLine2,
        'articleRef' => 'ART_'.str_pad((string) (abs(crc32($slug)) % 900 + 100), 3, '0', STR_PAD_LEFT),
    ]);
})->where('slug', '[a-z0-9]+(?:-[a-z0-9]+)*');
