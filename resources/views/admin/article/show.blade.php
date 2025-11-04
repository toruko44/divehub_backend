@extends('layout.admin')

@section('content')
    <x-admin-page-title>記事詳細</x-admin-page-title>
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">
        <x-card-title>記事詳細</x-card-title>

        <h1 class="text-center mb-6 text-2xl">{{ $article->title }}</h1>

        <div class="relative bg-white mx-4 rounded-lg mb-10 p-6 border border-gray-300 shadow-lg">

            <x-content-block :blocks="$article->content['blocks']" />

            <div class="mt-6 text-sm">
                <p>最終更新日: {{ $article->updated_at->format('Y/m/d') }}</p>
                <p>ユーザー名：{{ $article->user->name  }}</p>
            </div>
        </div>
        @vite('resources/js/editorjs.js')
    </div>
@endsection
