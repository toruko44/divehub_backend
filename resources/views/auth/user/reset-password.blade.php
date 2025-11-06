@extends('layout.user')

@section('content')
    <x-page-title-cloud title="パスワード再設定" img_name="reset_password" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['パスワード再設定', route('password.request')]]" />
    </div>

    <div
        class="flex min-h-full flex-col justify-center px-4 pb-[100px] sm:px-6 sm:pb-[200px] bg-gradient-to-b from-blue-50 to-cyan-50">
        <div class="text-center text-sm sm:text-base font-semibold tracking-wide">
            <p class="mb-1">パスワードをリセットします。下記に新しいパスワードを入力してください。</p>
        </div>
        <div
            class="mt-6 sm:mt-10 bg-white sm:mx-auto sm:w-full sm:max-w-2xl border-[3px] border-general-black rounded-[10px] px-4 py-6 sm:px-[2rem] sm:py-[2rem]">
            <form class="u-general-form" action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-3">

                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-2">
                        <div class="flex items-center justify-center sm:justify-end">
                            <label for="password"
                                class="block font-Kaisei-Opti font-medium text-sm sm:text-base leading-6 text-gray-900 text-center sm:text-right">パスワード</label>
                        </div>
                        <div class="mt-2 col-span-1 sm:col-span-2">
                            <input id="password" name="password" type="password" placeholder="●●●●●●●●"
                                autocomplete="current-password" required
                                class="w-full border-cyan-500 rounded border-2 border-general-black">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-2">
                        <div class="flex items-center justify-center sm:justify-end">
                            <label for="password_confirmation"
                                class="block font-Kaisei-Opti font-medium text-sm sm:text-base leading-6 text-gray-900 text-center sm:text-right">確認用パスワード</label>
                        </div>
                        <div class="mt-2 col-span-1 sm:col-span-2">
                            <input id="password_confirmation" name="password_confirmation" type="password"
                                placeholder="●●●●●●●●" autocomplete="current-password" required
                                class="w-full border-cyan-500 rounded border-2 border-general-black">
                        </div>
                    </div>
                </div>

                <input name="email" type="hidden" value="{{ request()->email }}">
                <input name="token" type="hidden" value="{{ $token }}">

                <div class="mt-6 flex justify-center">
                    <x-button class="mx-auto" tag="button" text="リセット" />
                </div>
            </form>
        </div>
    </div>
@endsection
