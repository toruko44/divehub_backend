@props([
  'name',
  'label',
  'options',
  'all_option_label' => '全て'
])

<div>
  <label for="{{ 'f-'.$name }}" class="p-filter-label">{{ $label ?? ' ' }}</label>
  <select name="{{ $name }}" id="{{ 'f-'.$name }}">
      <option value="">{{ $all_option_label }}</option>
      @foreach ($options as $key => $value)
          <option value="{{ $key }}" {{ request($name) === strval($key) ? 'selected' : '' }}>{{ $value }}</option>
      @endforeach
  </select>
</div>
