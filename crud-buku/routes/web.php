<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\HaloController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return "miaw";
});

Route::get('/halo', function () {
    return "Hallo Ukhasyah";
});

// Nested Blade Directory
Route::get('/haloh', function () {
    return view('halo.templatehalo');
});

// Controller
// uri, controller, function pada controller
Route::get('halo-con', [HaloController::class, 'index']);

Route::get('/buku', [BukuController::class, 'index'])->name('buku.index');
Route::post('/buku', [BukuController::class, 'store'])->name('buku.store');
Route::get('/buku/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');
Route::put('/buku/{id}/update', [BukuController::class, 'update'])->name('buku.update');
Route::delete('/buku/{id}/delete', [BukuController::class, 'destroy'])->name('buku.destroy');

