<x-admin-layout>

    <x-heading>
        Crear Libro
    </x-heading>
    <x-validation-errors />
    <form class="max-w-xl mx-auto mt-8" action="{{ route('admin.books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-5">
        <label for="title" class="block mb-2 text-sm font-medium text-gray-900">Titulo</label>
        <input type="text" value="{{ old('title', $book->title) }}" name="title" id="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Titulo" required />
    </div>

    <div class="mb-5">
        <label for="Categorías" class="block mb-2 text-sm font-medium text-gray-900">Categorías</label>
        @foreach ($categories as $category)
            <label for="category_{{ $category->id }}" class="inline-flex items-center">
                <input type="checkbox" name="categories[]" id="category_{{ $category->id }}" value="{{ $category->id }}" class="text-blue-500 focus:ring-blue-500 h-4 w-4 border-gray-300 rounded" 
                @if(in_array($category->id, old('categories', $book->categories->pluck('id')->toArray()))) checked @endif />
                <span class="ml-2 text-sm text-gray-900">{{ $category->name }}</span>
            </label>
        @endforeach
    </div>

    <div class="mb-5">
        <label for="author_id" class="block mb-2 text-sm font-medium text-gray-900">Autor</label>
        <select name="author_id" id="author_id" class="js-data-example-ajax block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" required>
            <option disabled selected>Selecciona un autor</option>
            @foreach ($authors as $author)
                <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-5">
        <label for="year" class="block mb-2 text-sm font-medium text-gray-900">Año</label>
        <input type="number" id="year" name="year" min="0" value="{{ old('year', $book->year) }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Año" required />
    </div>

    <div class="mb-5">
        <label for="file" class="block mb-2 text-sm font-medium text-gray-900">Upload file</label>
        <input name="file" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none" id="file_input" type="file">
    </div>

    <div class="mb-5">
        <label for="synopsis" class="block mb-2 text-sm font-medium text-gray-900">Descripción</label>
        <textarea id="synopsis" name="synopsis" rows="6" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Escriba aqui...">{{ old('synopsis', $book->synopsis) }}</textarea>
    </div>

    <x-button>
        Actualizar
    </x-button>
</form>

</x-admin-layout>