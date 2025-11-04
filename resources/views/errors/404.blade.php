@extends('layout.user')

@section('title', 'ページが見つかりません')

@section('content')
<div class="container mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">404 - ページが見つかりません</h1>
    <p class="text-lg mb-8">申し訳ありません。お探しのページは見つかりませんでした。</p>
    <a href="{{ url('/') }}" class="bg-cyan-500 text-white py-2 px-4 rounded hover:bg-cyan-600 transition duration-200">ホームに戻る</a>
</div>
@endsection
