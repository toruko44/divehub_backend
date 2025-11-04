<div class="space-y-3">
    @forelse ($answers as $answer)
        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
            <div class="mb-3">
                <p class="text-sm text-gray-500 mb-2">質問: <span class="font-medium text-gray-700">{{ $answer->question->title }}</span></p>
                <p class="text-gray-900 line-clamp-3">{{ $answer->content }}</p>
            </div>
            <div class="flex gap-2 justify-end">
                <a href="{{ route('user.question_box.show', $answer->question->id) }}" class="inline-block bg-cyan-500 text-white font-medium text-sm py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200">
                    詳細を見る
                </a>
                <form action="{{ route('user.answer.delete', $answer->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <button type="submit" class="inline-block bg-red-500 text-white font-medium text-sm py-2 px-4 rounded hover:bg-red-600 transition-colors duration-200">削除</button>
                </form>
            </div>
        </div>
    @empty
        <p class="text-gray-500 text-center py-8">投稿した回答はありません</p>
    @endforelse

    @if($answers->hasPages())
        <div class="mt-6">
            <x-pagination :items="$answers->appends(['tab' => 'answers'])" />
        </div>
    @endif
</div>
