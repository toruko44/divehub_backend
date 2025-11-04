@extends('layout.user')

@section('title', 'Forbidden')

@section('content')
<div class="container mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">403 - Forbidden</h1>
    <p class="text-lg mb-8">申し訳ありません。アクセスが禁止されています。</p>
    <a href="{{ url('/') }}" class="bg-cyan-500 text-white py-2 px-4 rounded hover:bg-cyan-600 transition duration-200">ホームに戻る</a>
</div>
@endsection
