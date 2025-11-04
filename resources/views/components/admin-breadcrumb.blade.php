@props(['items' => []])
<?php
// Example:
// $items = [
//   ['ホーム', route('admin.dashboard')],
//   ['管理者一覧', route('admin.admins.index')],
// ];
?>

<section class="flex">
    <ol class="inline-flex items-center space-x-1 md:space-x-1 ml-4">
        <li class="inline-flex items-center">
            <a href="{{ route('admin.dashboard') }}"
                class="inline-flex items-center c-breadcrumb-item c-breadcrumb-hover-item">
                ホーム
            </a>
        </li>

        @foreach ($items as $index => $array)
            <?php [$label, $path] = $array; ?>

            <li>
                <div class="flex items-center">
                    @if ($index === count($items) - 1)
                        <span class="c-breadcrumb-item">{{ $label }}</span>
                    @else
                        <a href="{{ $path }}"
                            class="c-breadcrumb-item c-breadcrumb-hover-item">{{ $label }}</a>
                    @endif
                </div>
            </li>
        @endforeach
    </ol>
</section>
