<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;






Route::controller(EmployeeController::class)->group(function () {
    Route::get('/employee', 'index')->name('index');
    Route::get('/employee/add', 'create')->name('create');
    Route::post('/employee', 'store')->name('store');
    Route::get('/employee/edit/{id}', 'edit')->name('edit');
    Route::put('/employee/update/{id}', 'update')->name('update');
    Route::get('/employee/delete/{id}', 'destroy')->name('destroy');
});
