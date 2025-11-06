<div class="space-y-3">
    @forelse ($questions as $question)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-grow">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $question->title }}</h3>
                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">{{ $question->content }}</p>
                    <div class="flex justify-end">
                        <a href="{{ route('user.question_box.show', $question->id) }}" class="inline-block bg-cyan-500 text-white font-medium text-sm py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200">
                            詳細を見る
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">投稿した質問はありません</p>
    @endforelse

    @if($questions->hasPages())
        <div class="mt-6">
            <x-pagination :items="$questions->appends(['tab' => 'questions'])" />
        </div>
    @endif
</div>
