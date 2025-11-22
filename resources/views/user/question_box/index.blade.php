@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">質問一覧</h1>
                    <p class="mt-1 text-sm text-gray-600">ダイビングに関する質問を投稿・閲覧できます</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <button type="button" id="openModalButtonQuestion"
                            class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        質問を投稿
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <x-breadcrumb :items="[['質問一覧', route('user.question_box.index')]]" />
    </div>

    <!-- Filter Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <form action="{{ route('user.question_box.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">カテゴリで絞り込み</label>
                    <select name="tag" id="tag" class="w-full border border-gray-300 rounded-md px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">すべてのカテゴリ</option>
                        @foreach(\App\Enums\TagType::toSelectArray() as $option_value => $option_label)
                            <option value="{{ $option_value }}" {{ $tag == $option_value ? 'selected' : '' }}>{{ $option_label }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end">
                    <button type="submit" 
                            class="w-full sm:w-auto px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-md transition-colors">
                        検索
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Questions List -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white border border-gray-200 rounded-lg">
            <div class="p-4 sm:p-6">
                <div class="space-y-4">
                    @foreach ($questions as $question)
                        <div class="border-b border-gray-200 last:border-b-0 pb-4 last:pb-0">
                            <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                                <div class="flex-1 min-w-0">
                                    <div class="flex flex-wrap items-center gap-1.5 mb-2">
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800 flex-shrink-0">
                                            {{ \App\Enums\TagType::from($question->tag->name)->label() ?? '一般' }}
                                        </span>
                                        @if($question->answers_count > 0)
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 flex-shrink-0">
                                                回答{{ $question->answers_count }}件
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 flex-shrink-0">
                                                未回答
                                            </span>
                                        @endif
                                        <span class="text-xs text-gray-500">
                                            {{ $question->created_at->format('Y年m月d日 H:i') }}
                                        </span>
                                    </div>
                                    <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2 line-clamp-2">
                                        <a href="{{ route('user.question_box.show', ['question_id' => $question->id]) }}" 
                                           class="hover:text-blue-600 transition-colors">
                                            {{ $question->title }}
                                        </a>
                                    </h3>
                                    <p class="text-sm text-gray-600 line-clamp-2">
                                        {{ Str::limit($question->content, 150, '...') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Pagination -->
                <div class="mt-6 pt-6 border-t border-gray-200">
                    <x-pagination :items="$questions" />
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <x-modal-question :tags="$tags" :edit=false />
@endsection
