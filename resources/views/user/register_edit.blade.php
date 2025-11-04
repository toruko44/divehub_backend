@extends('layout.user')
@section('content')
    <x-page-title-cloud title="ユーザー情報編集" img_name="register" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['ユーザー情報編集', route('user.register_edit',$user->id)]]" />
    </div>
    <div class="relative bg-gray-50 m-4 rounded-md">
        <div class="p-4">
            <form action="{{ route('user.register_update', $user->id) }}" method="POST" class="w-full max-w-lg mx-auto">
                @csrf
                @method('PUT')
                <x-user-field-layout label="ユーザー名" :required="true" class="mb-4">
                    <x-user-field-input name="name" value="{{ old('name', $user->name) }}" placeholder="山田 太郎" class="w-full" />
                    @error('name')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </x-user-field-layout>
                <hr class="my-3 border-dashed border-black" />
                <x-user-field-layout label="メールアドレス" :required="true" class="mb-4">
                    <x-user-field-input name="email" value="{{ old('email', $user->email) }}" class="w-full" />
                    @error('email')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </x-user-field-layout>
                <hr class="my-3 border-dashed border-black" />
                <x-user-field-layout label="パスワード" :required="false" class="mb-4">
                    <x-user-field-input type="password" name="password" class="w-full" />
                    @error('password')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                    <div class="text-gray-400 text-xs mt-1">
                        <p> ※パスワードを半角英数混在 (a~z、0~9) </p>
                        <p> 8文字以上で記力して下さい </p>
                    </div>
                </x-user-field-layout>
                <x-user-field-layout label="パスワード（確認用）" :required="false" class="mb-4">
                    <x-user-field-input type="password" name="password_confirmation" class="w-full" />
                    @error('password_confirmation')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                    <div class="text-gray-400 text-xs mt-1">
                        <p> ※パスワードを半角英数混在 (a~z、0~9) </p>
                        <p> 8文字以上で記力して下さい </p>
                    </div>
                </x-user-field-layout>
                <hr class="my-3 border-dashed border-black" />
                <x-user-field-layout label="ダイビングライセンス" :required="false" class="mb-4">
                    <x-user-field-input type="select" name="license"
                        :options="\App\Enums\LicenseType::toSelectArray()"
                        placeholder="選択してください"
                        value="{{ old('license', $user->license) }}"
                        class="w-full" />
                    @error('license')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                </x-user-field-layout>
                <div class="mt-6 flex justify-center">
                    <x-button class="mx-auto bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded w-full sm:w-auto"
                        tag="button" text="更新する" />
                </div>
            </form>
        </div>
    </div>
@endsection
