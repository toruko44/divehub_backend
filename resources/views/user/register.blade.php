@extends('layout.user')

@section('content')
    <!-- Header Section -->
    <div class="bg-white border-b border-gray-200">
        <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="text-center">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">新規登録</h1>
                <p class="text-sm text-gray-600">アカウントを作成してサービスをご利用ください</p>
            </div>
        </div>
    </div>

    <!-- Registration Form -->
    <div class="max-w-lg mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="bg-white border border-gray-200 rounded-lg p-6 sm:p-8">
            <form action="{{ route('user.register_post') }}" method="POST" class="space-y-6">
                @csrf
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                        ユーザー名 <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="name" id="name" 
                           placeholder="山田 太郎"
                           value="{{ old('name') }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                        メールアドレス <span class="text-red-500">*</span>
                    </label>
                    <input type="email" name="email" id="email" 
                           placeholder="example@email.com"
                           value="{{ old('email') }}" required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                        パスワード <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password" id="password" 
                           placeholder="8文字以上の半角英数混在"
                           required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">半角英数混在（a-z、0-9）、8文字以上で入力してください</p>
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                        パスワード（確認用） <span class="text-red-500">*</span>
                    </label>
                    <input type="password" name="password_confirmation" id="password_confirmation" 
                           placeholder="パスワードを再入力"
                           required
                           class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="license" class="block text-sm font-medium text-gray-700 mb-1">
                        ダイビングライセンス（任意）
                    </label>
                    <select name="license" id="license"
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        <option value="">選択してください</option>
                        @foreach(\App\Enums\LicenseType::toSelectArray() as $value => $label)
                            <option value="{{ $value }}" {{ old('license') == $value ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    @error('license')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-md transition-colors">
                        アカウントを作成
                    </button>
                </div>
            </form>

            <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    既にアカウントをお持ちの方は
                    <a href="{{ route('user.login') }}" class="text-blue-600 hover:text-blue-700 font-medium">
                        ログイン
                    </a>
                </p>
            </div>
        </div>
    </div>
@endsection
