@extends('layout.admin')

@section('content')
    <x-admin-page-title>お知らせ作成</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>お知らせ作成</x-card-title>

        <form action="{{ route('admin.news.store') }}" method="post">
            @csrf

            <div class="m-5">
                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-1">タイトル</label>
                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-1">内容</label>
                    <textarea name="content" id="content" rows="15" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">{{ old('content') }}</textarea>
                    @error('content')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('admin.news.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
                    <button type="submit" class="inline-block bg-cyan-500 text-white font-semibold py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200 ease-in-out">作成</button>
                </div>
            </div>
        </form>
    </div>
@endsection
