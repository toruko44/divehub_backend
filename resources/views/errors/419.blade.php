@extends('layout.user')

@section('title', 'ページの有効期限が切れました')

@section('content')
<div class="container mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">419 - ページの有効期限が切れました</h1>
    <p class="text-lg mb-8">申し訳ありません。セッションの有効期限が切れたため、リクエストを完了できませんでした。</p>
    <a href="{{ url()->previous() }}" class="bg-cyan-500 text-white py-2 px-4 rounded hover:bg-cyan-600 transition duration-200">前のページに戻る</a>
    <a href="{{ url('/') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 ml-4">ホームに戻る</a>
</div>
@endsection
