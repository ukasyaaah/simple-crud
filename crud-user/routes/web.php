<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::livewire('/count', 'pages::count.index');
Route::livewire('/users', 'pages::users');