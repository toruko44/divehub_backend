@extends('layout.admin')

@section('content')

    <x-admin-page-title>ユーザー詳細</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>ユーザー詳細</x-card-title>

        <div class="m-5">
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ユーザー名</label>
                <div class="text-lg">{{ $user->name }}</div>
            </div>
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                <div class="text-lg">{{ $user->email }}</div>
            </div>
            <div class="mb-4">
                <label for="license" class="block text-sm font-medium text-gray-700 mb-1">ライセンス</label>
                <div class="text-lg">{{ $user->license_label }}</div>
            </div>
            <div class="mb-4">
                <label for="created_at" class="block text-sm font-medium text-gray-700 mb-1">登録日時</label>
                <div class="text-lg">{{ $user->created_at->format('Y/m/d H:i') }}</div>
            </div>
        </div>

        <div class="m-5">
            <x-card-title>投稿した質問</x-card-title>
            <x-table>
                <thead>
                    <tr>
                        <th class="px-6 py-3">質問タイトル</th>
                        <th class="px-6 py-3">質問内容</th>
                        <th class="px-6 py-3">投稿日</th>
                        <th class="px-6 py-3">アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->questions as $question)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $question->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($question->content, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $question->created_at->format('Y/m/d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.question.show', $question->id) }}" class="text-cyan-600 hover:text-cyan-400">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>

        <div class="m-5">
            <x-card-title>投稿した回答</x-card-title>
            <x-table>
                <thead>
                    <tr>
                        <th class="px-6 py-3">回答内容</th>
                        <th class="px-6 py-3">質問タイトル</th>
                        <th class="px-6 py-3">投稿日</th>
                        <th class="px-6 py-3">アクション</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($user->answers as $answer)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($answer->content, 50) }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $answer->question->title }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $answer->created_at->format('Y/m/d H:i') }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.answer.show', $answer->id) }}" class="text-cyan-600 hover:text-cyan-400">詳細</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </x-table>
        </div>
    </div>
@endsection
