<div class="content-blocks">
    @foreach($blocks as $block)
        @switch($block['type'])
            @case('header')
                <h{{ $block['data']['level'] }} class="ce-header text-xl md:text-3xl font-bold my-4">
                    {!! html_entity_decode($block['data']['text'], ENT_QUOTES | ENT_HTML5, 'UTF-8') !!}
                </h{{ $block['data']['level'] }}>
                @break

            @case('paragraph')
                <div class="ce-paragraph my-4 text-base md:text-lg preserve-colors">
                    {!! html_entity_decode($block['data']['text'], ENT_QUOTES | ENT_HTML5, 'UTF-8') !!}
                </div>
                @break

            @case('list')
                @if($block['data']['style'] === 'ordered')
                    <ol class="ce-list ce-list--ordered list-decimal list-inside my-4 ml-4 text-base md:text-lg">
                @else
                    <ul class="ce-list ce-list--unordered list-disc list-inside my-4 ml-4 text-base md:text-lg">
                @endif
                @foreach($block['data']['items'] as $item)
                    <li class="my-2">{!! html_entity_decode($item, ENT_QUOTES | ENT_HTML5, 'UTF-8') !!}</li>
                @endforeach
                @if($block['data']['style'] === 'ordered')
                    </ol>
                @else
                    </ul>
                @endif
                @break

            @case('image')
                <figure class="ce-image my-6 flex flex-col items-center">
                    <img src="{{ $block['data']['file']['url'] }}" alt="{{ $block['data']['caption'] ?? 'Image' }}" class="ce-image__picture max-w-full h-auto rounded-lg shadow-md">
                    @if(!empty($block['data']['caption']))
                        <figcaption class="ce-image__caption text-sm sm:text-xs text-gray-600 mt-2 hidden sm:block">{{ $block['data']['caption'] }}</figcaption>
                    @endif
                </figure>
                @break

            @case('table')
                <div class="ce-table my-6 overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 text-sm md:text-base">
                        @foreach($block['data']['content'] as $row)
                            <tr>
                                @foreach($row as $cell)
                                    <td class="border border-gray-300 p-2">{!! $cell !!}</td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                @break

            @case('linkTool')
                <div class="ce-link-tool my-4 bg-gray-100 rounded-lg p-4">
                    <a href="{{ $block['data']['link'] }}" target="_blank" rel="noopener noreferrer" class="ce-link-tool__content block hover:bg-gray-200 transition duration-300">
                        @if(!empty($block['data']['meta']['title']))
                            <div class="ce-link-tool__title text-base md:text-lg font-semibold text-blue-600">{{ $block['data']['meta']['title'] }}</div>
                        @endif
                        @if(!empty($block['data']['meta']['description']))
                            <div class="ce-link-tool__description text-xs md:text-sm text-gray-600 mt-1">{{ $block['data']['meta']['description'] }}</div>
                        @endif
                        <div class="ce-link-tool__anchor text-xs text-gray-500 mt-2">{{ $block['data']['link'] }}</div>
                    </a>
                </div>
                @break

            @case('Delimiter')
                <div class="ce-delimiter my-8 flex justify-center text-2xl font-bold text-gray-500">
                </div>
                @break

            @case('inlineCode')
                <code class="inline-code bg-gray-200 rounded px-1 py-0.5">{!! $block['data']['code'] !!}</code>
                @break

            @case('Warning')
                <div class="ce-warning bg-yellow-100 border-l-4 border-yellow-500 p-4 my-4">
                    <h3 class="ce-warning__title text-base md:text-lg font-semibold text-yellow-700">{{ $block['data']['title'] ?? 'Warning' }}</h3>
                    <p class="ce-warning__message text-sm md:text-base text-yellow-600 mt-2">{{ $block['data']['message'] ?? '' }}</p>
                </div>
                @break

            @case('Color')
                <span style="color: {{ $block['data']['color'] }}">{!! $block['data']['text'] !!}</span>
                @break

            @case('Marker')
                <mark style="background-color: {{ $block['data']['color'] ?? '#FFEB3B' }}; color: inherit;">{!! $block['data']['text'] !!}</mark>
                @break
            @case('lineBreak')
                <div class="my-8"></div>
                @break
            @case('simpleLink')
                <a href="{{ $block['data']['url'] }}"
                   class="text-blue-500 underline break-words hover:text-blue-700"
                   style="word-break: break-word; overflow-wrap: break-word;"
                   target="_blank"
                   rel="noopener noreferrer">
                    {{ $block['data']['url'] }}
                </a>
                @break

            @default
                <div class="ce-block bg-red-100 border-l-4 border-red-500 p-4 my-4">
                    <div class="ce-block__content">
                        <p class="text-red-700">Unsupported block type: {{ $block['type'] }}</p>
                    </div>
                </div>
        @endswitch
    @endforeach
</div>
