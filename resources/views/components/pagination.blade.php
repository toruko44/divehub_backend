<!-- pagination -->
<?php
$current_page = $items->currentPage();
$last_page = $items->lastPage();
$start_page = max($current_page - 2, 1);
$end_page = min($current_page + 2, $last_page);
?>

@if ($last_page > 1)
    <div class="flex justify-center mt-6 pb-3">
        <ul class="flex list-none space-x-0.5 sm:space-x-1">
            <!-- Previous button -->
            @if ($current_page > 1)
                <li>
                    <a href="{{ $items->previousPageUrl() }}"
                        class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors duration-200 ease-in-out">
                        &laquo;
                    </a>
                </li>
            @endif

            <!-- Page numbers -->
            @if ($start_page > 2)
                <li>
                    <a href="{{ $items->url(1) }}"
                        class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors duration-200 ease-in-out">
                        1
                    </a>
                </li>
                <li><span class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight">...</span></li>
            @endif

            @for ($i = $start_page; $i <= $end_page; $i++)
                @if ($i == $current_page)
                    <li><span
                            class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-500 text-white rounded-full">{{ $i }}</span>
                    </li>
                @else
                    <li>
                        <a href="{{ $items->url($i) }}"
                            class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors duration-200 ease-in-out">
                            {{ $i }}
                        </a>
                    </li>
                @endif
            @endfor

            @if ($end_page < $last_page - 1)
                <li><span class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight">...</span></li>
                <li>
                    <a href="{{ $items->url($last_page) }}"
                        class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors duration-200 ease-in-out">
                        {{ $last_page }}
                    </a>
                </li>
            @endif

            <!-- Next button -->
            @if ($current_page < $last_page)
                <li>
                    <a href="{{ $items->nextPageUrl() }}"
                        class="flex items-center justify-center w-8 h-8 sm:w-10 sm:h-10 text-sm sm:text-base leading-tight bg-blue-400 text-white rounded-full hover:bg-blue-500 transition-colors duration-200 ease-in-out">
                        &raquo;
                    </a>
                </li>
            @endif
        </ul>
    </div>
@endif
