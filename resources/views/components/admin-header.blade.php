<div class="flex items-end max-w-[960px]">
  <div class="flex-1">
    {!! $left !!}
  </div>
  <div>
    @isset ($right)
      {!! $right !!}
    @endisset
  </div>
</div>
