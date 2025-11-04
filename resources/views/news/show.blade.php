@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">{{ $news_show->title }}</h1>
            <p class="mt-1 text-sm text-gray-500">
                投稿日: {{ $news_show->created_at->format('Y年m月d日') }}
            </p>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <x-breadcrumb :items="[
            ['お知らせ一覧', route('news.index')],
            ['お知らせ詳細', ''],
        ]" />
    </div>

    <!-- News Content -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <div class="prose max-w-none">
                <div class="text-gray-800 text-base sm:text-lg leading-relaxed whitespace-pre-wrap">
                    {!! nl2br(e($news_show->content)) !!}
                </div>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6">
            <a href="{{ route('news.index') }}"
               class="inline-flex items-center text-blue-600 hover:text-blue-700 text-sm font-medium">
                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                お知らせ一覧に戻る
            </a>
        </div>
    </div>
@endsection
