@extends('layout.admin')

@section('content')
    <?php
    $breadcrumb_items = [
        ['回答管理', route('admin.answer.index')],
        ['回答詳細', route('admin.answer.show', $answer->id)]
    ];
    ?>

    <x-admin-page-title>回答詳細</x-admin-page-title>
    <x-admin-breadcrumb :items="$breadcrumb_items" />

    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>回答詳細</x-card-title>

        <div class="m-5">
            <div class="mb-4">
                <label for="question_title" class="block text-sm font-medium text-gray-700 mb-1">質問タイトル</label>
                <div class="truncate w-64" title="{{ $answer->question->title }}">
                    <a href="{{ route('admin.question.show', $answer->question->id) }}" class="text-cyan-600 hover:text-cyan-400">
                        {{ $answer->question->title }}
                    </a>
                </div>
            </div>

            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">回答内容</label>
                <div class="truncate w-64" title="{{ $answer->content }}">{{ $answer->content }}</div>
            </div>

            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">ユーザー名</label>
                {{ $answer->user->name }}
            </div>

            <div class="mb-4">
                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">投稿日時</label>
                {{ $answer->created_at->format('Y/m/d H:i') }}
            </div>
        </div>
    </div>
@endsection
