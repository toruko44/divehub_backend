@extends('layout.admin')

@section('content')
    <x-admin-page-title>お問い合わせ詳細</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>お問い合わせ詳細</x-card-title>

        <div class="m-5">
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">メッセージ</label>
                <div class="text-lg font-bold">{{ $inquiry->message }}</div>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">ユーザーネーム</label>
                <div class="text-gray-800">{{ $inquiry->name }}</div>
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <div class="text-gray-800">{{ $inquiry->email }}</div>
            </div>
            <div class="mb-4">
                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">投稿日</label>
                <div class="text-gray-600">{{ $inquiry->created_at->format('Y-m-d') }}</div>
            </div>
            <div class="flex justify-end mt-4">
                <a href="{{ route('admin.inquiry.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
            </div>
        </div>
    </div>
@endsection
