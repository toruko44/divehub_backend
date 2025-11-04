@extends('layout.admin')

@section('content')

    <div class="flex items-center justify-between mb-5">
        <x-admin-page-title>bot回答管理</x-admin-page-title>
        @if ($existing_answer)
            <form action="{{ route('admin.question.bot', $question->id) }}" method="POST" class="mr-8">
                @csrf
                <button type="submit" class="px-4 py-2 bg-gray-500 text-white rounded transition duration-200" disabled>
                    bot回答作成
                </button>
            </form>
        @else
            <form action="{{ route('admin.question.bot', $question->id) }}" method="POST" class="mr-8">
                @csrf
                <button type="submit" class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-700 transition duration-200">
                    bot回答作成
                </button>
            </form>
        @endif
    </div>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>質問内容</x-card-title>
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 mb-1">質問タイトル</label>
            <div class="" title="{{ $question->title }}">{{ $question->title }}</div>
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-medium text-gray-700 mb-1">質問内容</label>
            <div class="" title="{{ $question->content }}">{{ $question->content }}</div>
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
    </div>

    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>bot回答一覧</x-card-title>
        @if ($claudes->isEmpty())
            <p class="text-gray-600">この質問にはまだ回答がありません。</p>
        @endif
        @if ($existing_answer)
            <p class="text-red-600">すでに回答済みです。</p>
        @else
            @if ($claudes->isNotEmpty())
                @foreach ($claudes as $claude)
                    <div class="mb-4 flex justify-between items-center">
                        <textarea class="flex-1 p-2 border border-gray-300 rounded h-64" name="claude_content">{{ $claude->content }}</textarea>
                        <input type="radio" name="selected_claude_id" value="{{ $claude->id }}" class="ml-4">
                    </div>
                @endforeach
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-700 transition duration-200 mt-4">
                    選択した回答を登録
                </button>
            @endif
        @endif
    </div>
@endsection
