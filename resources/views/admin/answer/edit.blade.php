@extends('layout.admin')

@section('content')
    <?php
    $breadcrumb_items = [
        ['回答管理', route('admin.answer.index')],
        ['回答編集', route('admin.answer.edit', $answer->id)]
    ];
    ?>

    <x-admin-page-title>回答編集</x-admin-page-title>
    <x-admin-breadcrumb :items="$breadcrumb_items" />

    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>回答編集</x-card-title>

        <form action="{{ route('admin.answer.update', $answer->id) }}" method="post">
            @csrf
            @method('put')

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
                    <textarea name="content" id="content" rows="10" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">{{ old('content', $answer->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <a href="{{ route('admin.answer.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
                    <button type="submit" class="inline-block bg-cyan-500 text-white font-semibold py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200 ease-in-out">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
