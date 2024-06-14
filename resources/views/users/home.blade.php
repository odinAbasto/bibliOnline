<x-app-layout>
    <section class="newBooks ">
        <h2 class="heading mt-4 flex font-semibold items-center text-2xl ">Novedades</h2>
        <p class="mb-2 text-lg text-gray-600">Libros mas recientes añadidos a la biblioteca</p>
        <div class="items ">
            @foreach ($newBooks as $newBook)
                <article class="bg-white  bg-white   shadow sm:rounded-md sm:rounded-md">
                    <figure class="overflow-hidden">
                        <img class="sm:rounded-md sm:rounded-md" src="{{ $newBook->cover_path ? 'http://localhost/storage/' . $newBook->cover_path : 'http://localhost/storage/covers/default_cover.jpg' }}"
                            alt="">
                    </figure>
                    <div class="p-2">
                        <h3 class="text-lg dark:text-white">{{ $newBook->title }}</h3>
                        <p class="text-sm dark:text-white">{{ isset($newBook['author']->name) ? $newBook['author']->name : 'Autor desconocido' }}</p>
                        <p class="text-sm dark:text-white">{{ $newBook->year }}</p>
                        <a href="{{ route('books.show', $newBook) }}"
                            class=" text-blue-600 dark:text-blue-400 hover:underline">Ver más</a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
    <section id="newBooks" class="resquests newBooks">
        <h2 class="heading mt-8 flex font-semibold items-center text-2xl dark:text-white">Solicitar un libro</h2>
        @auth
        <p class="mb-2 text-lg text-gray-600">Explora la base de datos de libros de Google Books y solicita alguno. Próximamente lo tendrás disponible para descargar</p>
        @else
        <p class="mb-2 text-lg text-gray-600">Debes<a href="{{route('login')}}" class="font-medium text-blue-600 dark:text-blue-500 hover:underline"> iniciar sesion</a> para poder solicitar un libro</p>
        @endauth

        @livewire('request-book-section')
    </section>
    <script>
        
        
        
        function addListeners() {
    let buttons = document.getElementsByClassName("show-more");    
    console.log(buttons);
    Array.from(buttons).forEach(button => {
        if (!button.listenerAdded) {
            button.addEventListener('click', function() {
                let content = this.previousElementSibling;

                content.classList.toggle('open');

                this.textContent = content.classList.contains('open') ? 'Leer menos' : 'Leer más';
            });
            button.listenerAdded = true; // Marcar el botón como que ya tiene el listener
        }

    });

    
}
        
        setInterval(addListeners, 1000);

    </script>

</x-app-layout>
