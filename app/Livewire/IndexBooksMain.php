<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Author;
use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;

class IndexBooksMain extends Component
{
    use WithPagination;
    public $search = "";

    public function render()
    {
        $books = Book::where('title', 'like', '%'.$this->search.'%')
        ->orWhereHas('author', function ($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orderBy('created_at', 'desc')
        ->with('author')
        ->paginate(3);
        return view('livewire.index-books-main', [
            'books' => $books
        ]);
    }
}
