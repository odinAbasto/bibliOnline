<div>
    <form wire:submit class="flex gap-2 relative">
        <div wire:loading.class="loading-hide" class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
            <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
            </svg>
        </div>
        <x-input wire:model.live="search" id="default-search"
            class="block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
            placeholder="Buscar por título o autor" autocomplete="off" required />
        
        <div wire:loading class="absolute top-2 left-2">
            <x-spinner class="h-10" />
        </div>
    </form>
    <div class="mt-4 apiBooks min-h-[800px]">
        @forelse ($books as $book)
            <article class="flex mb-2 bg-white shadow sm:rounded-md">
                <figure class="shrink-0 h-[200px]">
                    <img class="shrink-0 object-cover h-100 w-100"
                        src="
                {{ array_key_exists('imageLinks', $book['volumeInfo']) ? $book['volumeInfo']['imageLinks']['thumbnail'] : 'http://localhost/storage/covers/default_cover.jpg' }}"
                        alt="">
                </figure>
                <div class="info px-8 py-2 flex flex-col">
                    <span class="text-gray-400 mr-3 uppercase text-xs">{{ isset($author->name) ? $author->name : 'Autor desconocido'  }}</span>
                    <h3 class="text-lg font-bold">{{ $book['volumeInfo']['title'] }}</h3>
                    <p class="text-sm">
                        {{ array_key_exists('authors', $book['volumeInfo']) ? $book['volumeInfo']['authors'][0] : 'Autor no disponible' }}
                    </p>
                    <p class="text-sm text-black cursor-auto my-2">
                        {{ array_key_exists('publishedDate', $book['volumeInfo']) ? $book['volumeInfo']['publishedDate'] : 'Fecha no disponible' }}
                    </p>
                    <p class="text-sm content">
                        {{ array_key_exists('description', $book['volumeInfo']) ? $book['volumeInfo']['description'] : 'Descripción no disponible' }}
                    </p>
                    @if (array_key_exists('description', $book['volumeInfo']))
                        <a class="show-more mb-2 self-end">Leer mas</a>
                    @endif
                    @can('descargar libros')
                    <form action="{{route('request')}}" method="post" class="mt-auto self-end">
                        @csrf
                        <input type="hidden" name="url" value="{{ $book['selfLink'] }}">
                        <x-button  type="submit" class="block ms-auto" style="display:block;">{{$book['requested']?'solicitar':'solicitado'}}</x-button>
                    </form>
                    @endcan
                    
                </div>
            </article>
        @empty
            <p>No se encontraron resultados</p>
        @endforelse
    </div>
</div>
