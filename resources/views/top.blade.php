@extends('layout.user')

@section('content')
    <!-- Hero Section - OKWAVE inspired -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 sm:py-12">
            <div class="text-center">
                <p class="text-base sm:text-lg text-gray-600 mb-8 max-w-3xl mx-auto">
                    ダイビングに関する疑問を解決し、経験を共有する。初心者から上級者まで、みんなでダイビングの知識を深めましょう。
                </p>
                
                <!-- Feature highlights -->
                <div class="grid grid-cols-2 sm:grid-cols-2 gap-4 sm:gap-6 mb-8 max-w-4xl mx-auto">
                    <div class="text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">質問・回答</h3>
                        <p class="text-sm text-gray-600 hidden md:block">ダイビングの疑問をみんなで解決</p>
                        <div class="mt-4">
                            <button type="button" id="openModalButtonQuestion"
                                class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                                質問する
                            </button>
                        </div>
                    </div>
                    <div class="text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C20.832 18.477 19.246 18 17.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 mb-1">記事投稿</h3>
                        <p class="text-sm text-gray-600 hidden md:block">ダイビング体験や知識を共有</p>
                        <div class="mt-4">
                            <a href="{{ route('user.article.create') }}" 
                               class="inline-flex items-center justify-center px-4 py-2 border-2 border-green-600 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-50 transition-colors">
                                記事を作る
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Category Tabs -->
        <div class="mb-8">
            <nav class="flex space-x-8 border-b border-gray-200" aria-label="Tabs">
                <button class="border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600">
                    最新の質問
                </button>
            </nav>
        </div>

        <!-- Questions Section -->
        <div class="mb-12">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">最新の質問</h2>
                <a href="{{ route('user.question_box.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    すべて見る →
                </a>
            </div>
            
            <div class="space-y-4">
                @foreach ($questions as $question)
                    <div class="bg-white border border-gray-200 rounded-lg p-4 sm:p-6 hover:shadow-md transition-shadow">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-4">
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ \App\Enums\TagType::from($question->tag->name)->label() ?? '一般' }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $question->created_at->format('Y/m/d') }}
                                    </span>
                                </div>
                                <h3 class="text-base sm:text-lg font-medium text-gray-900 mb-2 hover:text-blue-600 line-clamp-2">
                                    <a href="{{ route('user.question_box.show', ['question_id' => $question->id]) }}">
                                        {{ $question->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit($question->content, 120, '...') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Articles Section -->
        <div>
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl sm:text-2xl font-bold text-gray-900">人気の記事</h2>
                <a href="{{ route('user.article.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">
                    すべて見る →
                </a>
            </div>
            
            <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 gap-3 sm:gap-6">
                @foreach ($article_reports as $article_report)
                    <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow">
                        <a href="{{ route('user.article.show', ['article_id' => $article_report->id]) }}" class="block">
                            <div class="aspect-video bg-gray-100">
                                @if($article_report->image && $article_report->image->path)
                                    <img src="{{ $article_report->image->path }}" 
                                         alt="{{ $article_report->title }}" 
                                         class="w-full h-full object-cover">
                                @else
                                    @php
                                        $placeholders = [
                                            '/images/article_tour_placeholder.PNG',
                                            '/images/article_divelog_placeholder.PNG'
                                        ];
                                        $randomPlaceholder = $placeholders[array_rand($placeholders)];
                                    @endphp
                                    <img src="{{ asset($randomPlaceholder) }}" 
                                         alt="記事のプレースホルダー画像" 
                                         class="w-full h-full object-cover">
                                @endif
                            </div>
                            <div class="p-2 sm:p-4">
                                <h3 class="font-medium text-gray-900 mb-1 sm:mb-2 line-clamp-2 hover:text-blue-600 text-sm sm:text-base">
                                    {{ $article_report->title }}
                                </h3>
                                <div class="text-xs sm:text-sm text-gray-500">
                                    {{ $article_report->created_at->format('m/d') }}
                                </div>
                            </div>
                        </a>
                    </article>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Modal for Question Posting -->
    <x-modal-question :tags="[]" :edit=false />
@endsection
