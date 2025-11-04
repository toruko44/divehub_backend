@props([
    'label' => '',
    'name' => '',
    'required' => null,
    'hint' => '',
    'class' => '',
])

<div class="{{ $class }} flex flex-col sm:flex-row items-start justify-start gap-4">
    <label for="{{ $name }}" class="block w-full sm:w-3/12 h-full py-2">
        {{ $label }}
    </label>

    <div class="w-full sm:w-3/12 h-full flex justify-start items-start">
        @if ($required === true)
            <span class="text-sm rounded-md px-3 py-2 mt-1 whitespace-nowrap max-w-xs border-2 border-cyan-300">必須</span>
        @endif
        <label class="text-gray-400 text-center ml-auto py-2">{{ $hint }}</label>
    </div>

    <div class="block w-full sm:w-9/12">
        {{ $slot }}
    </div>
</div>
