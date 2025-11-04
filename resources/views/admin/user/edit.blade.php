@extends('layout.admin')

@section('content')
    <x-admin-page-title>ユーザー編集</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>ユーザー編集</x-card-title>

        <form action="{{ route('admin.user.update', $user->id) }}" method="post">
            @csrf
            @method('put')

            <div class="m-5">
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">ユーザー名</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">メールアドレス</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">パスワード</label>
                    <input type="password" name="password" id="password" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                    <p class="text-gray-500 text-xs mt-1">パスワードを変更する場合のみ入力してください</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">パスワード確認</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                </div>
                <div class="mb-4">
                    <label for="license" class="block text-sm font-medium text-gray-700 mb-1">ライセンス</label>
                    <select name="license" id="license" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm">
                        @foreach ($licenseTypes as $licenseType)
                            <option value="{{ $licenseType->value }}" @if (old('license', $user->license) == $licenseType->value) selected @endif>{{ $licenseType->label() }}</option>
                        @endforeach
                    </select>
                    @error('license')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('admin.user.index') }}" class="inline-block bg-gray-500 text-white font-semibold py-2 px-4 rounded hover:bg-gray-600 transition-colors duration-200 ease-in-out mr-2">戻る</a>
                    <button type="submit" class="inline-block bg-cyan-500 text-white font-semibold py-2 px-4 rounded hover:bg-cyan-600 transition-colors duration-200 ease-in-out">更新</button>
                </div>
            </div>
        </form>
    </div>
@endsection
