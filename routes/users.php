<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\BookController;
use App\Http\Controllers\RequestedBookController;

Route::resource('/books', BookController::class)
    ->names('books');

Route::get('/', [App\Http\Controllers\User\HomeController::class, 'index'])->name('home');

Route::post('/request', [RequestedBookController::class, 'store'])->name('request');