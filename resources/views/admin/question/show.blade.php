@extends('layout.admin')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <x-admin-page-title>質問箱詳細</x-admin-page-title>
        <a href="{{ route('admin.question.bot_index',$question->id) }}" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-200 mr-8">
            bot回答一覧
        </a>
    </div>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>質問詳細</x-card-title>

        <div class="m-5">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">質問タイトル</label>
                <div class="truncate w-64" title="{{ $question->title }}">{{ $question->title }}</div>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">質問内容</label>
                <div class="truncate w-64" title="{{ $question->content }}">{{ $question->content }}</div>
            </div>
            <div class="mb-4">
                <label for="tag_id" class="block text-sm font-medium text-gray-700 mb-1">質問タグ</label>
                {{ \App\Enums\TagType::from($question->tag->name)->label() ?? '一般' }}
            </div>
            <div class="mb-4">
                <label for="user_name" class="block text-sm font-medium text-gray-700 mb-1">ユーザー名</label>
                {{ $question->user->name }}
            </div>
            <div class="mb-4">
                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">作成日時</label>
                {{ $question->created_at->format('Y/m/d H:i') }}
            </div>

            <div class="mb-4">
                <label for="answers" class="block text-sm font-medium text-gray-700 mb-1">回答一覧</label>
                @if ($question->answers->isEmpty())
                    <p class="text-gray-600">この質問にはまだ回答がありません。</p>
                @else
                    <ul class="list-disc list-inside space-y-2">
                        @foreach ($question->answers as $answer)
                                <div class="flex justify-between items-center">
                                    <div class="" title="{{ $answer->content }}">{{ $answer->content }}</div>
                                    <span class="text-sm text-gray-500">{{ $answer->created_at->format('Y/m/d H:i') }}</span>
                                </div>
                                <div class="text-sm text-gray-500">回答者: {{ $answer->user->name }}</div>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
@endsection
