@extends('layout.admin')

@section('content')
    <x-admin-page-title>お知らせ詳細</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>お知らせ詳細</x-card-title>

        <div class="m-5">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                <div class="text-lg font-bold">{{ $news_item->title }}</div>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">内容</label>
                <div class="text-gray-800">{!! nl2br(e($news_item->content)) !!}</div>
            </div>
            <div class="mb-4">
                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">投稿日</label>
                <div class="text-gray-600">{{ $news_item->created_at->format('Y-m-d') }}</div>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('admin.news.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
                <a href="{{ route('admin.news.edit', $news_item->id) }}" class="inline-block bg-blue-500 text-white font-semibold py-2 px-4 rounded hover:bg-blue-600 transition-colors duration-200 ease-in-out">編集</a>
            </div>
        </div>
    </div>
@endsection
