@extends('layout.user')

@section('title', 'Unauthorized')

@section('content')
<div class="container mx-auto text-center py-16">
    <h1 class="text-4xl font-bold mb-4">401 - Unauthorized</h1>
    <p class="text-lg mb-8">申し訳ありません。認証が必要です。</p>
    <a href="{{ url('/') }}" class="bg-cyan-500 text-white py-2 px-4 rounded hover:bg-cyan-600 transition duration-200">ホームに戻る</a>
</div>
@endsection
