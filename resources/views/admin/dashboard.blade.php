@extends('layout.admin')

@section('content_header')
    <?php
    $breadcrumb_items = [];
    ?>

    <x-admin-page-title>ダッシュボード</x-admin-page-title>
    <x-admin-breadcrumb :items="$breadcrumb_items" />
@endsection

@section('content')
    <div class="bg-white rounded-md shadow-lg border-cyan-500 border-t-2 p-6 m-4">

        <x-card-title>メニュー</x-card-title>
        <?php
        $nav_list = [
            ['ユーザー管理', route('admin.user.index')],
            ['質問箱管理', route('admin.question.index')],
            ['回答管理',route('admin.answer.index')],
            ['お知らせ管理',route('admin.news.index')],
            ['お問い合わせ',route('admin.inquiry.index')],
            ['記事一覧', route('admin.article.index')],
        ];
        ?>

        <div class="grid grid-cols-5 gap-4">
            @foreach ($nav_list as [$label, $path])
                <a class="block py-[4rem] bg-cyan-600 hover:bg-cyan-400 rounded-xl text-white text-lg font-medium text-center"
                    href="{{ $path }}">{{ $label }}</a>
            @endforeach
        </div>
    </div>
@endsection
