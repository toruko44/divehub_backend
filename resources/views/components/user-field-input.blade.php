@props([
    'name' => '',
    'type' => 'text',
    'options' => ['1' => '有', '0' => '無'],
    'value' => '',
    'required' => false,
    'placeholder' => '',
    'error_name' => str_replace(['[', ']'], ['.', ''], $name),
    'error_show' => true,
    'class' => '',
])

<div class="{{ $class }}">

    @if($type === 'text' || $type === 'email' || $type === 'number')
        <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}" value="{{ old($name, $value) }}" placeholder="{{ $placeholder }}" class="w-full px-3 py-2 border-2 border-general-black rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ $placeholder }}" @required($required)>

    @elseif($type === 'radio')
        <div class="flex flex-wrap gap-3 my-2">
            @foreach ($options as $option_value => $option_label)
                <label class="inline-flex items-center mb-2 sm:mb-0">
                    <input type="radio" id="{{ $name }}_{{ $option_value }}" name="{{ $name }}" value="{{ $option_value }}" class="form-radio" style="accent-color: black;" {{ old($name, $value) == $option_value ? 'checked' : '' }} @required($required)>
                    <span class="ml-2 text-sm sm:text-base">{{ $option_label }}</span>
                </label>
            @endforeach
        </div>

    @elseif($type === 'select')
        <select name="{{ $name }}" id="{{ $name }}" class="w-full border-2 border-general-black rounded-md px-3 py-2 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @required($required)>
            <option value="">{{ $placeholder }}</option>
            @foreach ($options as $option_value => $option_label)
                <option value="{{ $option_value }}" {{ old($name, $value) == $option_value ? 'selected' : '' }}>{{ $option_label }}</option>
            @endforeach
        </select>

    @elseif($type === 'password')
        <input type="password" name="{{ $name }}" id="{{ $name }}" value="{{ old($name) }}" placeholder="{{ $placeholder }}" autocomplete="new-password" class="w-full px-3 py-2 border-2 border-general-black rounded-md focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" @required($required)>

    @elseif($type === 'toggle')
        <div class="flex items-center ml-2">
            <input type="hidden" name="{{ $name }}" value="0" @required($required)>
            <label class="inline-flex items-center cursor-pointer">
                <input type="checkbox" id="{{ $name }}" name="{{ $name }}" value="1" class="form-checkbox scale-125" style="accent-color: black;" {{ old($name, $value) == '1' ? 'checked' : '' }}>
                <span class="ml-2 text-sm sm:text-base">{{ $placeholder }}</span>
            </label>
        </div>

    @elseif($type === 'textarea')
        <textarea name="{{ $name }}" id="{{ $name }}" rows="5" class="w-full h-full resize-none border-2 border-general-black rounded-md py-2 px-3 focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="{{ $placeholder }}" @required($required)>{{ old($name, $value) }}</textarea>

    @elseif($type === 'multiple')
        <div class="ml-2">
            @foreach ($options as $option_value => $option_label)
                @php
                    $is_checked = in_array($option_value, old($name, is_array($value) ? $value : []));
                @endphp
                <label class="inline-flex items-center mb-2">
                    <input type="checkbox" id="{{ $name }}_{{ $option_value }}" name="{{ $name }}[]" value="{{ $option_value }}" class="form-checkbox" style="accent-color: black;" {{ $is_checked ? 'checked' : '' }}>
                    <span class="ml-2 text-sm sm:text-base">{{ $option_label }}</span>
                </label><br>
            @endforeach
        </div>

    @endif

    {{-- @error($error_name)
        @if ($error_show)
            <div class="p-form-group__error-message">
                <span>{{ $message }}</span>
            </div>
        @endif
    @enderror --}}

</div>
