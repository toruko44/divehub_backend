@props([
    'title' => '',
    'img_name' => '',
])

<div class="flex items-center justify-center text-general-black relative my-4">
    <img src="{{ asset('images/icons/icon_' . $img_name . '.svg') }}" alt="page-title" class="object-contain max-h-8 mr-4">
    <h1 class="text-center text-2xl sm:text-3xl leading-4 tracking-wider">
        {{ $title }}
    </h1>
</div>
