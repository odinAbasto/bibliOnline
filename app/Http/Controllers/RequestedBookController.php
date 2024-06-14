<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RequestedBook;
class RequestedBookController extends Controller
{
    public function index(){

        $requestedBooks = RequestedBook::all();
        return view('admin.dashboard', compact('requestedBooks'));
    }


    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'url' => 'required|string',
        ]);
        
        if(RequestedBook::where('url', $request->url)->exists()){
            return redirect()->route('home');
        }

        RequestedBook::create($request->all());
        return redirect()->route('home');
    }
}
