@extends('layout.user')

@section('content')
    <x-page-title-cloud title="記事詳細" img_name="article" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[
            ['記事一覧', route('user.article.index')],
            ['記事詳細', ''],
        ]" />
    </div>

    <div class="max-w-6xl px-4 mx-auto">
        <h1 class="text-center mb-6 text-2xl">{{ $article_report->title }}</h1>

        <div class="relative bg-white rounded-lg mb-10 p-6 border border-gray-300 shadow-lg break-words">
            <x-content-block :blocks="$article_report->content['blocks']" />

                <div class="mt-6 text-sm flex justify-between items-center">
                    <p class="m-0">最終更新日: {{ $article_report->updated_at->format('Y/m/d') }}</p>
                    <a href="{{ route('user.profile', $article_report->user->id) }}"
                       class="text-gray-600 text-sm sm:text-base m-0">
                        {{ $article_report->user->name }}
                    </a>
                </div>
        </div>
    </div>
    @vite('resources/js/editorjs.js')
@endsection
