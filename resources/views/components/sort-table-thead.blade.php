@props([
  'columns' => [],
  'sort_keys' => [],
  'sort' => '',
  'route_name' => '',
])

<thead>
  <tr>
  @foreach ($columns as $key => $label)
    <th>
      @if (isset($$key)) <!-- カスタムのレンダーを指定した場合 -->
        {!! $$key !!}
      @else
        @if (in_array($key, $sort_keys))
          <?php
            $sort_by_value = $key == $sort
              ? '-'.$key
              : $key;
            $route = route($route_name, array_merge(request()->query(), ['sort' => $sort_by_value, 'page' => 1]));
          ?>
          <a href="{{ $route }}" class="">
            <span>{{ $label }}</span>
            <span class="ml-1 leading-3">
              @if ($sort == $key)
                <!-- Up Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="inline-block" viewBox="0 0 16 16">
                  <path d="m7.247 4.86-4.796 5.481c-.566.647-.106 1.659.753 1.659h9.592a1 1 0 0 0 .753-1.659l-4.796-5.48a1 1 0 0 0-1.506 0z"/>
                </svg>
              @elseif ($sort == '-'.$key)
                <!-- Down Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="inline-block" viewBox="0 0 16 16">
                  <path d="M7.247 11.14 2.451 5.658C1.885 5.013 2.345 4 3.204 4h9.592a1 1 0 0 1 .753 1.659l-4.796 5.48a1 1 0 0 1-1.506 0z"/>
                </svg>
              @else
                <!-- Sort Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="inline-block" viewBox="0 0 16 16">
                  <path fill-rule="evenodd" d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                </svg>
              @endif
            </span>
          </a>
        @else
            {{ $label }}
        @endif
      @endif
    </th>
  @endforeach
  </tr>
</thead>