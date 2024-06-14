<x-admin-layout>

<x-heading>
Libros
</x-heading>
@livewire('index-books')  

</x-admin-layout>
<script>
    document.getElementById("new").addEventListener("click", function() {
    window.location.href = "{{route('admin.books.create')}}";
});
</script>