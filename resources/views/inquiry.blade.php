@extends('layout.user')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <x-page-title-cloud title="お問い合わせ" img_name="mailform" />

        <p class="text-gray-600 text-base leading-relaxed mb-4 text-center tracking-wide mt-2">
            お問い合わせではユーザーの要望や疑問点を受け付けております。<br>
            必要事項を記入の上、送信ボタンを押してください。
        </p>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6 text-center">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('inquiry_post') }}" method="POST" class="max-w-3xl mx-auto bg-white p-6 rounded-lg shadow-lg">
            @csrf
            <!-- 入力フォームの項目 -->
            <div class="mb-6">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">ユーザーネーム</label>
                <div class="relative">
                    <input type="text" name="name" id="name" class="mt-1 block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm pl-3" value="{{ old('name') }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-user text-gray-400"></i>
                    </div>
                </div>
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">メールアドレス</label>
                <div class="relative">
                    <input type="email" name="email" id="email" class="mt-1 block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm pl-3" value="{{ old('email') }}">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-envelope text-gray-400"></i>
                    </div>
                </div>
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="message" class="block text-sm font-medium text-gray-700 mb-2">メッセージ</label>
                <div class="relative">
                    <textarea name="message" id="message" rows="4" class="mt-1 block w-full border border-cyan-500 rounded-md shadow-sm focus:ring-cyan-500 focus:border-cyan-500 sm:text-sm pl-3">{{ old('message') }}</textarea>
                </div>
                @error('message')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="text-center mb-4">
                <button type="submit" class="bg-cyan-500 text-white px-4 py-2 rounded hover:bg-cyan-600 transition duration-300">送信</button>
            </div>

            <!-- プライバシーポリシーの文 -->
            <div class="text-gray-600 text-sm mb-6 mx-auto text-center">
                <p>お客様からのお問い合わせに関して、当社はお客様の個人情報を厳重に保護します。提供いただいた情報は、お問い合わせに回答する目的のみに使用され、第三者に開示または提供することはありません。</p>
                <p><a href="/privacy_policy" class="text-cyan-500 hover:text-cyan-600">プライバシーポリシー</a>をご確認ください。</p>
            </div>
        </form>
    </div>
@endsection

