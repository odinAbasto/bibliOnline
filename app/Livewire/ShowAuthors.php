<?php
namespace App\Livewire;
use Livewire\Component;
use Illuminate\Support\Collection;
use App\Models\Author;
use App\Models\Book;
use Livewire\Attributes\Title;
use Livewire\WithPagination;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Validate;



class showAuthors extends Component
{
    use WithPagination;
    #[Validate]
    public $name = '';


    public function render()

    {
        $authors = Author::where('name', 'like', '%'.$this->name.'%')
        ->orderBy('created_at', 'desc')
        ->withCount('books')
        ->paginate(10);
        return view('livewire.show-authors', [
            'authors' => $authors
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate();
        Author::create($validatedData);
        $this->reset('name');
        $this->resetPage();

    }
    public function rules()
    {
        return [
            'name' => 'required|min:5|unique:authors,name',
        ];
    }

    public function delete($id)
    {
        $author = Author::find($id);
        $author->delete();
        $this->reset('name');
    }

   
}

