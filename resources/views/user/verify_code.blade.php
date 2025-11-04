@extends('layout.user')
@section('content')
    <x-page-title-cloud title="認証コードの入力" img_name="register" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['認証コードの入力', route('user.verify_code')]]" />
    </div>
    <div class="relative bg-gray-50 m-4 rounded-md">
        <div class="p-4">
            <form action="{{ route('user.verify_code_post') }}" method="POST" class="w-full max-w-lg mx-auto">
                @csrf
                <input type="hidden" name="email" value="{{ session('email') }}">

                <x-user-field-layout label="認証コード" :required="true" class="mb-4">
                    <x-user-field-input name="code" value="" placeholder="123456" class="w-full" />
                    @error('code')
                        <span class="text-red-500 text-sm block mt-1">{{ $message }}</span>
                    @enderror
                    <div class="text-gray-400 text-xs mt-1">
                        <p> ※認証コードはメールに記載されています。 </p>
                        <p> ※15分以内に入力してください。</p>
                    </div>
                </x-user-field-layout>

                <div class="mt-6 flex justify-center">
                    <x-button class="mx-auto bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-4 rounded w-full sm:w-auto"
                        tag="button" text="認証" />
                </div>
            </form>
        </div>
    </div>
@endsection
