<div>
<form wire:submit=save class="mb-4" autocomplete="off">
    <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
            <div class="relative flex mt-2 mr-2" >
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live="name" type="search" id="default-search" class="  mr-2 block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Buscar por título o autor" autocomplete="off" required />
                {{-- <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button> --}}
                <x-button class="px-100" id="new">
                    Añadir
                </x-button>
            </div>
            
    @if(strlen($name) > 4 && $authors->count() == 0)
        {{-- <x-validation-errors />     --}}
        <p class="mt-2 text-blue-500">Puede añadir un nuevo autor </p>
    @endif
</form>

<table style="width:100%" class="max-w-4xl w-full display text-sm text-left rtl:text-right text-gray-500 ">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
        <tr>
            <th scope="col" class="px-6 py-3">
                Nombre
            </th>
            <th scope="col" class="px-6 py-3">
                Libros
            </th>
            <th scope="col" class="px-6 py-3">
                Acciones
            </th>
        </tr>
    </thead>
    <tbody>
        @forelse ($authors as $author)
        <tr class="bg-white border-b ">
            <td class="px-6 py-4">
                {{ isset($author->name) ? $author->name : 'Autor desconocido'}}
            </td>
            <td class="px-6 py-4">
                {{ $author->books_count }}
            </td>
            <td class="px-6 py-4">
                <x-danger-button wire:click="delete({{ $author->id }})">
                    Eliminar
                </x-danger-button>
                
            </td>
        </tr>
        @empty
        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
            <td class="px-6 py-4" colspan="2">
                No hay resultados
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="my-2">
    {{ $authors->links() }}
</div>
</div>



