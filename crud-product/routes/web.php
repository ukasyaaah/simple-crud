<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'create')->name('create');
    Route::post('/add', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'destroy')->name('destroy');
});
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::get('/register', 'showRegister')->name('auth.register');
    Route::get('/login', 'showLogin')->name('auth.login');
    Route::post('/register', 'register')->name('register');
    Route::post('/login', 'login')->name('login');
    Route::post('/logout', 'logout')->name('logout')->middleware('auth');
    Route::get('/logout', fn() => redirect()->route('auth.login'));
});
