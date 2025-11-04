@extends('layout.user')

@section('content')
    <x-page-title-cloud title="退会" img_name="retire" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['退会', route('user.retire')]]" />
    </div>

    <div class="flex flex-col px-4 mb-6 sm:px-6">
        <div class="text-center text-sm sm:text-base font-semibold tracking-wide">
            <p class="mb-1">退会をご希望の方は、<br class="u-only-sp">下記のフォームより退会手続きを行ってください。</p>
            <p>退会手続きが完了すると、アカウントおよび関連データは削除されますのでご注意ください。</p>
        </div>
        <div
            class="mt-6 sm:mt-10 bg-gray-50 sm:mx-auto sm:w-full sm:max-w-2xl border-[3px] border-general-black rounded-[10px] px-4 py-6 sm:px-[2rem] sm:py-[2rem] shadow-xl">
            <form class="" action="{{ route('user.retire_post') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div class="text-center">
                        <p class="font-Kaisei-Opti text-sm sm:text-base leading-6 text-gray-900">本当に退会しますか？</p>
                    </div>
                    <div class="text-center text-sm sm:text-base text-red-600">
                        <p>退会すると、すべてのアカウント情報が削除され、元に戻すことはできません。</p>
                    </div>
                </div>
                <div class="mt-6 flex justify-center">
                    <button type="submit" class="btn bgleft px-4 py-2 font-bold rounded bg-gray-300 hover:bg-gray-400 text-gray-800">
                        <span>退会する</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
