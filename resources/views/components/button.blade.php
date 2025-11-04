@props([
    'tag' => 'a',
    'link' => '#',
    'text' => 'ボタン',
])

@if ($tag === 'a')
    <a href="{{ $link }}"
        class="inline-block relative border-2 rounded-full border-general-black bg-cyan-500 px-8 py-1 text-white sm:px-10 sm:py-1.5 hover:opacity-80">
        <span class="text-sm sm:text-base font-semi-blod tracking-wide font-Kaisei-Opti">{{ $text }}</span>
        {{-- <img src="{{asset('images/top/arrow-icon-1.png')}}" class="w-4 object-contain absolute top-[calc(50%-7px)] right-[0.4rem]"> --}}
    </a>
@elseif ($tag === 'button')
    <button type="submit"
        class="inline-block relative border-2 rounded-full border-general-black bg-cyan-500 px-8 py-1 text-white sm:px-10 sm:py-1.5 hover:opacity-80">
        <span class="text-sm sm:text-base font-semibold tracking-wide font-Kaisei-Opti">{{ $text }}</span>
        {{-- <img src="{{asset('images/top/arrow-icon-1.png')}}" class="w-4 object-contain absolute top-[calc(50%-7px)] right-[0.4rem]"> --}}
    </button>
@endif
