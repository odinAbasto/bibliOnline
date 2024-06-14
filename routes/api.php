<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Author;
use App\Models\Category;
use Yajra\DataTables\Facades\DataTables;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/authors', function(Request $request) {
    $authors = Author::select('id', 'name')
        ->withCount('books')
        ->get();
    
    return response()->json($authors);
})->name('api.authors.index');

Route::get('categories', function(Request $request) {
    $categories = Category::select('id', 'name')
        ->get();
    return response()->json($categories);
})->name('api.categories.index');