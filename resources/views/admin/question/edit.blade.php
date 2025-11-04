@extends('layout.admin')

@section('content')
    <x-admin-page-title>質問箱編集</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>質問編集</x-card-title>

        <form action="{{ route('admin.question.update', $question) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 m-5">
                <div class="col-span-1">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">質問タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $question->title) }}" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-1">
                    <label for="tag" class="block text-sm font-medium text-gray-700 mb-1">質問タグ</label>
                    <select name="tag" id="tag" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                        @foreach ($tags as $value => $label)
                            <option value="{{ $value }}" @if (old('tag', $question->tag->id) == $value) selected @endif>{{ \App\Enums\TagType::from($label)->label() }}</option>
                        @endforeach
                    </select>
                    @error('tag')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-1 md:col-span-2">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">質問内容</label>
                    <textarea name="content" id="content" rows="10" class="w-full h-40 border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">{{ old('content', $question->content) }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-1">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-1">質問画像</label>
                    @if ($question->image)
                        <div class="mb-4">
                            <img src="{{ $question->image->path }}" alt="{{ $question->title }}" class="w-full h-auto rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image" class="w-full border border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-span-1 md:col-span-2 flex justify-end mt-4">
                    <a href="{{ route('admin.question.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
                    <button type="submit" class="inline-block bg-cyan-500 text-white font-semibold py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200 ease-in-out">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
