<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;
use App\Models\Book;

class AuthorController extends Controller
{
    //

    public function index()
    {
         $authors = Author::withCount('books')->paginate(10);
         return view('admin.authors.index', compact('authors'));
       


    }
}
