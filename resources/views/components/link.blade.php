@props([
    'href' => '#',
    'class' => '',
])

<a href="{{ $href }}"
    class="text-blue-800 font-medium hover:text-indigo-900 {{ $class }}">{{ $slot }}</a>
