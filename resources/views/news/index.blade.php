@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">お知らせ一覧</h1>
                    <p class="mt-1 text-sm text-gray-600">運営からのお知らせや最新情報をご確認いただけます</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Breadcrumb -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <x-breadcrumb :items="[['お知らせ一覧', route('news.index')]]" />
    </div>

    <!-- News List -->
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pb-8">
        <div class="bg-white border border-gray-200 rounded-lg">
            <div class="p-4 sm:p-6">
                <div class="space-y-4">
                    @forelse ($news as $item)
                        <div class="border-b border-gray-200 last:border-b-0 pb-4 last:pb-0">
                            <div class="flex flex-col gap-2">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        お知らせ
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $item->created_at->format('Y年m月d日') }}
                                    </span>
                                </div>
                                <h3 class="text-base sm:text-lg font-medium text-gray-900">
                                    <a href="{{ route('news.show', ['news_id' => $item->id]) }}"
                                       class="hover:text-blue-600 transition-colors">
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ Str::limit(strip_tags($item->content), 150, '...') }}
                                </p>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                            <p class="mt-2 text-sm text-gray-500">お知らせはありません</p>
                        </div>
                    @endforelse
                </div>

                <!-- Pagination -->
                @if(method_exists($news, 'links'))
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <x-pagination :items="$news" />
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
