@extends('layout.user')

@section('content')
    <x-page-title-cloud title="パスワード再設定" img_name="forget_password" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['パスワード再設定', route('password.request')]]" />
    </div>

    <div class="flex min-h-full flex-col justify-center px-4 pb-[100px] sm:px-6 sm:pb-[200px]">
        <div class="text-center text-sm sm:text-base font-semibold tracking-wide">
            <p class="mb-1">パスワードリセットを行う為のメールを送信します。下記に<span class="text-red-600">「登録したメールアドレス」</span>を入力してください。</p>
        </div>
        <div
            class="mt-6 sm:mt-10 bg-white sm:mx-auto sm:w-full sm:max-w-2xl border-[3px] border-general-black rounded-[10px] px-4 py-6 sm:px-[2rem] sm:py-[2rem]">
            <form class="" action="#" method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="grid grid-cols-1 sm:grid-cols-3 sm:gap-2">
                        <div class="flex items-center justify-center sm:justify-end">
                            <label for="email"
                                class="block font-Kaisei-Opti font-medium text-sm sm:text-base leading-6 text-gray-900 text-center sm:text-right">メールアドレス</label>
                        </div>
                        <div class="col-span-1 sm:col-span-2">
                            <input id="email" name="email" type="email" placeholder="tarou@email.com"
                                autocomplete="email" required value="{{ old('email') }}"
                                class="w-full border-cyan-500 rounded border-2 border-general-black ">
                        </div>
                    </div>
                </div>

                <div class="mt-6 flex justify-center">
                    <x-button class="mx-auto" tag="button" text="情報を送る" />
                </div>
            </form>
        </div>
    </div>
@endsection
