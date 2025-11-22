@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">記事一覧</h1>
                    <p class="mt-1 text-sm text-gray-600">ダイビングに関する記事やレポートを投稿・閲覧できます</p>
                </div>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('user.article.create') }}">
                        <button type="button" 
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            記事を作成
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <x-breadcrumb :items="[['記事一覧', route('user.article.index')]]" />
    </div>

    <!-- Search Section -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-6">
        <div class="bg-white border border-gray-200 rounded-lg p-4">
            <form action="{{ route('user.article.index') }}" method="GET" class="flex flex-col sm:flex-row gap-3">
                <div class="flex-1">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトルで検索</label>
                    <input type="text" name="title" id="title" value="{{ request('title') }}" 
                           placeholder="記事タイトルを入力"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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

    <!-- Articles Grid -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="grid grid-cols-2 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 sm:gap-6">
            @foreach ($article_reports as $article_report)
                <article class="bg-white border border-gray-200 rounded-lg overflow-hidden hover:shadow-md transition-shadow duration-200">
                    <a href="{{ route('user.article.show', ['article_id' => $article_report->id]) }}" class="block">
                        <!-- Thumbnail -->
                        <div class="aspect-video bg-gray-100 relative overflow-hidden">
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
                            <!-- Article Type Badge -->
                            <div class="absolute top-1 left-1 sm:top-2 sm:left-2">
                                <span class="inline-flex items-center px-1.5 py-0.5 sm:px-2 sm:py-1 rounded-full text-xs font-medium bg-white bg-opacity-90 text-gray-700">
                                    記事
                                </span>
                            </div>
                        </div>
                        
                        <!-- Content -->
                        <div class="p-2 sm:p-4">
                            <h3 class="font-medium text-gray-900 mb-1 sm:mb-2 hover:text-blue-600 transition-colors text-sm sm:text-base line-clamp-2">
                                {{ $article_report->title }}
                            </h3>
                            <div class="flex items-center justify-between text-xs text-gray-500">
                                <span>{{ $article_report->created_at->format('m/d') }}</span>
                                <span class="hidden sm:inline">{{ $article_report->user->name ?? '匿名' }}</span>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($article_reports->hasPages())
            <div class="mt-8 flex justify-center">
                <x-pagination :items="$article_reports" />
            </div>
        @endif
    </div>
@endsection
