<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;
use App\Models\RequestedBook;



class RequestBookSection extends Component
{

    private $api_url = 'https://www.googleapis.com/books/v1/volumes?q=intitle:';
    private $options = '&maxResults=5&projection=lite&langRestrict=es&printType=books&orderBy=relevance';
    public $search = '';
    private $books;


    public function render()
    {
        $response = Http::get($this->api_url . $this->search. $this->options);
        try {
            $this->books = $response->json()['items'];
        } catch (\Exception $e) {
            $this->books = [];
        }



        foreach ($this->books as $key=>$book) {
            $this->books[$key]['requested']= false;
            $requested = RequestedBook::where('url', $book['selfLink'])->exists();
            if(!$requested) {
                $this->books[$key]['requested'] = true;
            }
        }

        return view('livewire.request-book-section', [
            'books' => $this->books
        ]);
        
    }

    

}
