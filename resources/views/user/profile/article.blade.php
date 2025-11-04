<div class="space-y-3">
    @forelse ($article_reports as $article_report)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex justify-between items-center">
                <a href="{{ route('user.article.show', ['article_id' => $article_report->id]) }}" class="text-gray-900 hover:text-cyan-600 font-semibold text-lg transition-colors duration-200 flex-grow">
                    {{ $article_report->title }}
                </a>
                <a href="{{ route('user.article.show', ['article_id' => $article_report->id]) }}" class="inline-block bg-cyan-500 text-white font-medium text-sm py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200 ml-4 flex-shrink-0">
                    詳細を見る
                </a>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">投稿した記事はありません</p>
    @endforelse

    @if($article_reports->hasPages())
        <div class="mt-6">
            <x-pagination :items="$article_reports->appends(['tab' => 'articles'])" />
        </div>
    @endif
</div>
