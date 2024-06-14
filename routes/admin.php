<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\AuthorController;




Route::middleware('role:admin')->group(function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::resource('/admin/books', BookController::class)
    ->names('admin.books');
    
    Route::resource('/admin/authors', AuthorController::class)
    ->names('admin.authors');
    Route::get('/admin/books/{book}/download', [BookController::class, 'download'])->name('admin.books.download');
});
