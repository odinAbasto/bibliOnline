<x-admin-layout>
<x-validation-errors />
  <section class="book_view_admin flex flex-col gap-8 lg:flex-row">
    <div class="img-container max-w-[300px] w-[300px] aspect-[2/3] mx-auto md:w-[300px] md:min-w-[300px] md:mx-0">
        <img 
            alt="book cover" 
            src="{{$book->cover_path ? 'http://localhost/storage/'.$book->cover_path : 'http://localhost/storage/covers/default_cover.jpg'}}" 
            class="w-full h-full object-cover block mx-auto"
        >
    </div>
    <div class="info mt-8">
        <h2 class="text-gray-400 mr-3 uppercase text-xs">{{isset($author->name) ? $author->name : 'Autor desconocido'}}</h2>
        <h1 class="text-2xl font-bold">{{$book->title}}</h1>
         <span class="text-sm text-black cursor-auto my-2">{{$book->year}}</span>
        <div class="info__categories my-2">
    
            <div class="info__categories__list flex gap-x-2 gap-y-1 flex-wrap mt-2">
                @foreach($categories as $category)
                    <x-category-tag>{{$category}}</x-category-tag>
                @endforeach
                @if (count($categories) == 0)
                    <span>No se ha agregado categoria</span>
                @endif
            </div>
        </div>
        <p class="text-sm text dark:text-white content">{{$book->synopsis}}</p>
        <div class="info__buttons mt-4 flex space-x-4">
            <a class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150'" href="{{route('admin.books.download', $book->id)}}">Descargar</a>

            <form  action="{{route('admin.books.destroy', $book->id)}}" method="POST">
                @csrf
                @method('DELETE')
                <x-danger-button type="submin" >Borrar</x-danger-button>
            </form>
            <x-update-button href="{{route('admin.books.edit', $book->id)}}">Editar</x-update-button>
        </div>
    </div>
</section>



</x-admin-layout>