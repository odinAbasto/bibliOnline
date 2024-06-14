<x-admin-layout>

@push('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css" rel="stylesheet" />

@endpush
<x-heading>
Autores
</x-heading>

<div id="container">
</div>

<div class="relative  overflow-x-auto mb-2">
    @livewire('show-authors')  
 
</div>

</x-admin-layout>