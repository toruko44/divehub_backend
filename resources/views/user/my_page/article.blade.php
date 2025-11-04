<div class="space-y-3">
    @forelse ($article_reports as $article_report)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                <div class="flex-grow">
                    <a href="{{ route('user.article.show', ['article_id' => $article_report->id]) }}" class="text-gray-900 hover:text-cyan-600 font-semibold text-lg transition-colors duration-200">
                        {{ $article_report->title }}
                        @if ($article_report->is_draft)
                            <span class="text-sm text-orange-600 font-normal">(下書き)</span>
                        @endif
                    </a>
                </div>
                <div class="flex gap-2 flex-shrink-0">
                    <a href="{{ route('user.article.edit', ['article_id' => $article_report->id]) }}" class="inline-block bg-green-600 text-white font-medium text-sm py-2 px-4 rounded hover:bg-green-700 transition-colors duration-200">
                        編集
                    </a>
                    <form action="{{ route('user.article.delete', $article_report->id) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit" class="inline-block bg-red-500 text-white font-medium text-sm py-2 px-4 rounded hover:bg-red-600 transition-colors duration-200">削除</button>
                    </form>
                </div>
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
