@extends('layout.login')

@section('content')
    <div class="flex min-h-full flex-col justify-center px-6 py-[200px]">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-gray-900">管理者ログイン</h2>
        </div>

        <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
            <form class="u-form --md" action="{{ route('admin.login_post') }}" method="POST">
                @csrf
                <div class="flex flex-col gap-3">
                    <div>
                        <label for="email" class="block text-sm font-medium leading-6 text-gray-900">メールアドレス</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" required
                                value="{{ old('email') }}"
                                class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>

                    <div>
                        <div class="flex items-center justify-between">
                            <label for="password" class="block text-sm font-medium leading-6 text-gray-900">パスワード</label>
                        </div>
                        <div class="mt-2">
                            <input id="password" name="password" type="password" autocomplete="current-password" required
                                class="pl-2 block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        </div>
                    </div>
                    <div class="flex">
                        <input id="remember" name="remember" type="checkbox"
                            class="rounded border-gray-300 text-cyan-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <label for="remember" class="ml-2 block text-sm leading-5 text-gray-900">ログイン状態を保持する</label>
                    </div>

                </div>

                <div class="mt-6">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-cyan-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-emerald-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">ログイン</button>
                </div>
            </form>
        </div>
    </div>
@endsection
