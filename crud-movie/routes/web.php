<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::movies.index')->name('movies.index');
Route::livewire('/create', 'pages::movies.create')->name('movies.create');
Route::livewire('/edit/{id}', 'pages::movies.edit')->name('movies.edit');
