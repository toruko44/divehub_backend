@props(['items' => []])
<?php
// Example:
// $items = [
//   ['管理者一覧', route('admin.admins.index')],
// ];
?>

<section class="flex text-general-black mt-2 mb-8 md:mb-12">
    <ol class="inline-flex items-center flex-wrap space-x-1 md:space-x-1">
        <li>
            <a href="{{ route('top') }}" class="hover:text-cyan-500 text-xs sm:text-sm md:text-base tracking-wide">
                TOP
            </a>
        </li>

        @foreach ($items as $index => $array)
            <?php [$label, $path] = $array; ?>

            <li>
                <div class="flex items-center">
                    <span class="mx-1">&gt;</span>
                    @if ($index === count($items) - 1)
                        <span class="text-xs sm:text-sm md:text-base tracking-wide">{{ $label }}</span>
                    @else
                        <a href="{{ $path }}"
                            class="hover:text-cyan-500 text-xs sm:text-sm md:text-base tracking-wide">{{ $label }}</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</section>
