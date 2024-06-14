<div class="mt-8 ">
    
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
    <div class=" relative flex" >
        <div   class=" absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500 " aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
    <input wire:model.live="search" type="search" id="default-search" class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500" placeholder="Buscar por título o autor" required />

</div>
    <section id="Projects" class="">
        @foreach ($books as $book)
        <a href="{{ route('books.show', $book->id) }}" class="">
        <article class="bg-white flex  duration-500 shadow sm:rounded-md  my-4  bg-white shadow sm:rounded-tl-md sm:rounded-tr-md ">
            <div class=" flex-none shrink-0 border-black" style="width:100px">
                <img src="{{ $book->cover_path ? 'http://localhost/storage/' . $book->cover_path : 'http://localhost/storage/covers/default_cover.jpg' }}" alt="Product" class="object-cover sm:rounded" style="width:100%; height:100%" />
            </div>

            <div class="p-2"> 
                <span class="text-gray-400 mr-3 uppercase text-xs">{{ isset($author->name) ? $author->name : 'Autor desconocido'  }}</span>

                
                    <p class="text-lg font-bold capitalize">{{ $book->title }}</p>
                
                <p class="text-sm text-black cursor-auto my-2">{{ $book->year }}</p>
                <p class="text-sm  text-gray-500 overflow-hidden cursor-auto my-2" style="max-height: 5ch">{{ $book->synopsis . $book->synopsis }}</p>
            </div>
        </article>
    </a>
        @endforeach
        @if($books->count() == 0)
        <p class="mt-2">No hay resultados</p>
        @endif
    </section>

    
    
    <div class="mt-2">
        {{ $books->links() }}
    </div>
</div>
