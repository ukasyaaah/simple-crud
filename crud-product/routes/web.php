<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::controller(ProductController::class)->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/add', 'create')->name('create');
    Route::post('/add', 'store')->name('store');
    Route::get('/edit/{id}', 'edit')->name('edit');
    Route::put('/edit/{id}', 'update')->name('update');
    Route::get('/delete/{id}', 'destroy')->name('destroy');
});
