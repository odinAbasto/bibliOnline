
@php

$links = [
    [
        'name'=>'Dashboard',
        'url'=>route('admin.dashboard'),
        'active'=>request()->routeIs('admin.dashboard'),
        'icon' => 'bi bi-speedometer',
    ],
    [
        'name'=>'Books',
        'url'=>route('admin.books.index'),
        'active'=>request()->routeIs('admin.books.*'),
        'icon' => 'bi bi-collection',
        ],
    [
        'name'=>'Authors',
        'url'=>route('admin.authors.index'),
        'active'=>request()->routeIs('admin.authors.*'),
        'icon' => 'bi bi-people'],
        [
            'name'=>'Main',
            'url'=>route('home'),
            'active'=>request()->routeIs('home'),
            'icon' => 'bi bi-house-door'],
        




];
@endphp




<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200">
   <span class="sr-only">Open sidebar</span>
   <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
   <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
   </svg>
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-100 ">
      <a href="{{route('home')}}" class="flex items-center ps-2.5 mb-5">
         <x-application-mark class="block h-9 w-auto mr-2" />
         <span class="self-center text-xl font-semibold whitespace-nowrap ">bibliOnline</span>
      </a>
      
    <ul class="space-y-2 font-medium">
         @foreach($links as $link)

         <li>
            
            <a href="{{$link['url']}}" class="flex items-center p-2 text-gray-900 rounded-lg  hover:bg-gray-200  group {{$link['active']? 'bg-gray-200' : ''}}">
               <i class="{{$link['icon']}} text-gray-900"></i>
               <span class="ms-3">{{__($link['name'])}}</span>
            </a>
         </li>
         
         @endforeach
         <form method="POST" action="{{ route('logout') }}" x-data class="flex items-center" >
            @csrf
            <i class="bi bi-box-arrow-left ms-2"></i>
            <a class=" pt-2 pr-2 pb-2 ps-3 flex items-center text-gray-900 rounded-lg hover:bg-gray-100 group" href="{{ route('logout') }}" @click.prevent="$root.submit(); ">
               {{ __('Cerrar sesion') }}
            </a>
      </form>
      </ul>
   </div>
</aside>

