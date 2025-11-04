@extends('layout.user')

@section('title', 'Bad Request')

@section('content')
<div class="container mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">400 - Bad Request</h1>
    <p class="text-lg mb-8">申し訳ありません。リクエストが不正です。</p>
    <a href="{{ url('/') }}" class="bg-cyan-500 text-white py-2 px-4 rounded hover:bg-cyan-600 transition duration-200">ホームに戻る</a>
</div>
@endsection
