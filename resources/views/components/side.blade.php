<aside class="card-modern p-6 w-full mb-4">
    <h2 class="text-xl font-semibold mb-6 text-cyan-800 border-b border-cyan-200 pb-3">お知らせ</h2>
    <ul class="space-y-3">
        @foreach ($news as $index => $news_item)
            <li class="flex items-center py-3 px-2 hover:bg-cyan-50 rounded-lg transition duration-300 ease-in-out hover-lift">
                <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full mr-3 shadow-md">
                    <span class="text-white font-semibold text-sm">{{ $index + 1 }}</span>
                </div>
                <div class="flex-1">
                    <a href="{{ route('news.show', $news_item->id) }}" class="text-gray-700 hover:text-cyan-700 text-sm font-medium">
                        {{ Str::limit($news_item->title, 30, '...') }}
                    </a>
                    <p class="text-xs text-gray-500 mt-1">{{ $news_item->created_at->format('Y/m/d') }}</p>
                </div>
            </li>
        @endforeach
    </ul>
</aside>
