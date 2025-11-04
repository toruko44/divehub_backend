<div class="card-modern mb-8 overflow-hidden hover-lift avoid-break flex flex-col">
    <a href="{{ $url }}" class="block text-gray-800 no-underline flex-grow flex flex-col">
        <div class="gallery-content p-6 flex-grow flex flex-col">
            <span class="tag-primary mb-4">
                {{ $tagLabel ?? '一般' }}
            </span>
            @if ($imagePath)
                <div class="gallery-image flex justify-center mb-5 overflow-hidden rounded-lg">
                    <img src="{{ $imagePath }}" alt="{{ $title }}" class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105">
                </div>
            @endif
            <div class="flex items-center space-x-3 mb-3">
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 font-bold text-4xl">Q</span>
                <h3 class="font-bold text-xl text-gray-800">{{ $title }}</h3>
            </div>
            <div class="h-px w-full bg-gradient-to-r from-cyan-200 to-blue-200 my-3"></div>
            <p class="text-gray-600 leading-relaxed flex-grow">{{ $content }}</p>
        </div>
    </a>
    <div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-4 text-right">
        <span class="inline-flex items-center text-cyan-600 hover:text-cyan-800 text-sm font-medium">
            詳細を見る
            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
            </svg>
        </span>
    </div>
</div>
