<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;

class HomeController extends Controller
{
    public function index()
    {
        $newBooks = Book::with('author')->orderBy('created_at', 'desc')->take(5)->get();

        return view('users.home', [
            'newBooks' => $newBooks]);
    }
}
