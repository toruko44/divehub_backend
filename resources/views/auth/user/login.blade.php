@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">ログイン</h1>
                <p class="text-sm text-gray-600">アカウントにログインしてサービスをご利用ください</p>
            </div>
        </div>
    </div>

    <!-- Login Form -->
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <form action="{{ route('user.login_post') }}" method="POST" class="space-y-6">
                @csrf
                <input type="hidden" name="redirect_to" value="{{ old('redirect_to', URL::previous()) }}">
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        メールアドレス
                    </label>
                    <input id="email" name="email" type="email" 
                           placeholder="example@email.com"
                           autocomplete="email" required 
                           value="{{ old('email') }}"
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        パスワード
                    </label>
                    <input id="password" name="password" type="password" 
                           placeholder="パスワードを入力"
                           autocomplete="current-password" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="text-sm">
                    <a href="{{ route('password.request') }}" class="text-blue-600 hover:text-blue-700">
                        パスワードを忘れた方はこちら
                    </a>
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                        ログイン
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    アカウントをお持ちでない方は
                    <a href="{{ route('user.register') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        新規登録
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
