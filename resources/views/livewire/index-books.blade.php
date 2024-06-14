<div>

       
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
            <div class="relative flex mb-4" >
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input wire:model.live="search" type="search" id="default-search" class="  mr-2 block w-full p-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500  placeholder="Buscar por título o autor" required />
                <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150" href={{route('admin.books.create')}}>
                    Nuevo
                </a>
            </div>

    <div class="relative overflow-x-auto">

        <table class="w-full text-sm text-left rtl:text-right text-gray-500">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 ">
                <tr>

                    <th scope="col" class="px-6 py-3">
                        Titulo
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Autor
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Fecha de publicación
                    </th>

                </tr>
            </thead>
            <tbody>
                @foreach ($books as $book)
                <tr class="bg-white border-b ">

                    <td class="px-6 py-4 flex gap-2 items-center ">
                        <a href="{{route('admin.books.show', $book->id)}}" class="text-blue-600 dark:text-blue-400 hover:underline">{{$book->title}}</a>
                    </td>
                    <td class="px-6 py-4">
                        {{isset($book->author->name) ? $book->author->name : 'Autor desconocido'}}

                    </td>
                    <td class="px-6 py-4">
                        {{$book->year}}
                    </td>



                </tr>
                @endforeach
                @if($books->count() == 0)
                <tr>
                    <td class="px-6 py-4" colspan="4">
                        No hay resultados
                    </td>
                </tr>

                @endif


            </tbody>
        </table>

          <div class="mt-2">
            {{$books->links()}}
        </div> 
    </div>
</div>

</div>

