@props([
    'name',
    'type' => 'text',
    'label',
    'placeholder' => '',
])

<div class="mb-4">
    <label for="{{ 'f-'.$name }}" class="block text-sm font-medium text-gray-700 mb-1">{{ $label }}</label>
    <input
        type="{{ $type }}"
        name="{{ $name }}"
        id="{{ 'f-'.$name }}"
        placeholder="{{ $placeholder }}"
        value="{{ request($name, '') }}"
        class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500"
    >
</div>
