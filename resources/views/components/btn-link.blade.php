<a {{ $attributes->merge(['href' => '/', 'class' => 'inline-flex items-center px-4 py-2  border border-gray rounded-md font-semibold text-xs  uppercase tracking-widest hover:bg-white-700  active:bg-white-900  focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2  ease-in-out duration-150']) }}>
    {{ $slot }}
</a>
