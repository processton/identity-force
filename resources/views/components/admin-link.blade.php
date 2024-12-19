@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-white dark:border-white text-sm font-medium leading-5 text-gray-50 dark:text-gray-100 focus:outline-none focus:border-indigo-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-gray-50 dark:text-gray-100 hover:text-gray-200 dark:hover:text-gray-300 hover:border-white dark:hover:border-gray-700 focus:outline-none focus:text-gray-200 dark:focus:text-gray-200 focus:border-white dark:focus:border-white transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
