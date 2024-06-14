<a {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-50 transition ease-in-out duration-150                 
 bg-yellow-400 hover:bg-yellow-500   focus:ring-yellow-300   text-center  dark:focus:ring-yellow-900']) }}>
    {{ $slot }}
</a>