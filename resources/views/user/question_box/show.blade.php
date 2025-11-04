@extends('layout.user')

@section('content')
    @php
        $items = [
            ['質問一覧', route('user.question_box.index')],
            ['質問詳細', route('user.question_box.show', ['question_id' => $question->id])],
        ];
    @endphp
    <x-page-title-cloud title="質問詳細" img_name="board" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="$items" />
    </div>

    <div class="max-w-6xl px-4 mx-auto">
        <div class="relative bg-white rounded-lg mb-10 p-6">
            <div class="mb-6">
                <div class="flex justify-between items-center mb-4">
                    <span class="inline-block bg-blue-600 text-white text-xs font-semibold px-2 py-1 rounded shadow">
                        {{ \App\Enums\TagType::from($question->tag->name)->label() ?? '一般' }}
                    </span>
                    <a href="{{ route('user.profile', $question->user->id) }}" class="text-gray-600 text-sm sm:text-base">投稿者: {{ $question->user->name }}</a>
                </div>
                <h1 class="text-2xl sm:text-4xl font-bold">{{ $question->title }}</h1>
            </div>

            <div class="flex flex-col items-center -mx-2">
                @if ($question->image)
                    <div class="w-full sm:w-1/2 px-2 mb-6 flex justify-center items-start">
                        <img src="{{ $question->image->path }}" alt="{{ $question->title }}" class="w-full h-auto rounded">
                    </div>
                @endif
                <div class="w-full px-2 mb-6 border-t border-gray-300 pb-4">
                    <p class="text-gray-800 text-base sm:text-xl mt-4">{{ $question->content }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-6xl px-4 mx-auto">
        <div class="mt-6 flex flex-col sm:flex-row justify-between items-center p-6">
            <a href="{{ route('user.question_box.index') }}" class="text-blue-500 hover:underline text-sm sm:text-base">質問一覧に戻る</a>
            <div class="mt-4 sm:mt-0">
                @if (Auth::check() && Auth::user()->id == $question->user_id)
                    <button type="button" id="openModalButtonQuestion" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-green-700 text-sm sm:text-base mr-2">
                        質問を編集する
                    </button>
                @elseif (Auth::check() && isset($user_answer) && Auth::user()->id == $user_answer->user_id)
                    <button type="button" id="openAnswerModalButton" class="px-4 py-2 font-bold text-white bg-green-500 rounded hover:bg-blue-700 text-sm sm:text-base">
                        回答を編集する
                    </button>
                @else
                    <button type="button" id="openAnswerModalButton" class="px-4 py-2 font-bold text-white bg-blue-500 rounded hover:bg-blue-700 text-sm sm:text-base">
                        質問に回答する
                    </button>
                @endif
            </div>
        </div>
    </div>

    <div class="max-w-6xl px-4 mx-auto">
        <div class="mt-10 p-6">
            <h2 class="text-xl sm:text-2xl font-bold mb-4">回答一覧</h2>
            <div class="flex flex-col items-center">
                @foreach ($answers as $answer)
                    <div class="mb-6 p-4 bg-gray-100 rounded-lg shadow w-full">
                        <div class="flex justify-between items-center mb-2">
                            <a href="{{ route('user.profile', $answer->user->id) }}" class="text-gray-600 text-sm sm:text-base">回答者: {{ $answer->user->name }}</a>
                            <p class="text-gray-500 text-xs sm:text-sm">{{ $answer->created_at->format('Y-m-d H:i') }}</p>
                        </div>
                        <p class="text-gray-800 text-sm sm:text-base break-words">{!! nl2br(e(\App\Helpers\TextHelper::autoLinkUrls($answer->content))) !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="max-w-6xl px-4 mx-auto">
        <div class="mt-10">
            <h2 class="text-xl sm:text-2xl font-bold mb-4 text-cyan-800">他の質問</h2>
            <div class="overflow-x-auto pb-4" id="related-questions-container">
            <div class="flex space-x-4">
                @foreach ($related_questions as $index => $related_question)
                    <div class="card-modern mb-6 w-80 min-w-[20rem] max-w-[20rem] flex-shrink-0 slide-in-down" data-index="{{ $index }}" id="related-card-{{ $index }}">
                        <a href="{{ route('user.question_box.show', ['question_id' => $related_question->id]) }}" class="block p-4 text-gray-800 no-underline h-full flex flex-col">
                            <div class="gallery-content flex-grow">
                                <span class="tag-primary inline-block mb-4">
                                    {{ \App\Enums\TagType::from($related_question->tag->name)->label() ?? '一般' }}
                                </span>
                                @if ($related_question->image)
                                    <div class="gallery-image flex justify-center mb-4 overflow-hidden rounded-lg">
                                        <img src="{{ $related_question->image->path }}" alt="{{ $related_question->title }}" class="w-full h-auto object-cover transition-transform duration-500 hover:scale-105">
                                    </div>
                                @endif
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 font-bold text-3xl">Q</span>
                                    <h3 class="font-bold text-lg line-clamp-2">{{ $related_question->title }}</h3>
                                </div>
                                <div class="h-px w-full bg-gradient-to-r from-cyan-200 to-blue-200 my-3"></div>
                                <p class="text-gray-600 text-sm line-clamp-4">
                                    {{ $related_question->content }}
                                </p>
                            </div>
                            <div class="mt-4 text-right">
                                <span class="inline-flex items-center text-cyan-600 hover:text-cyan-800 text-sm font-medium">
                                    詳細を見る
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </span>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>

    <style>
        @keyframes slideInDown {
            from {
                transform: translateY(-30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .slide-in-down {
            opacity: 0;
        }

        .slide-in-down.visible {
            animation: slideInDown 0.5s ease forwards;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.getElementById('related-questions-container');
            const cards = document.querySelectorAll('.slide-in-down');
            let animationStarted = false;

            const observer = new IntersectionObserver((entries) => {
                // コンテナが表示されたかチェック
                if (entries[0].isIntersecting && !animationStarted) {
                    animationStarted = true; // アニメーションが開始されたことをマーク

                    // すべてのカードに対してアニメーションを開始
                    cards.forEach(card => {
                        const index = card.dataset.index;
                        setTimeout(() => {
                            card.classList.add('visible');
                        }, index * 150); // 各カードに少しずつ遅延をつける
                    });

                    // 一度表示されたら監視を解除
                    observer.unobserve(container);
                }
            }, {
                root: null, // ビューポートを基準にする
                threshold: 0.2, // 20%見えたらトリガー
                rootMargin: '0px' // マージンなし
            });

            // コンテナ全体を監視
            observer.observe(container);
        });
    </script>

    @if (Auth::check() && Auth::user()->id == $question->user_id)
        <x-modal-question :edit="true" :tags="$tags" :question="$question" />
    @elseif ($user_answer)
        <x-modal-answer :answer="$user_answer" :question="$question" :edit="true" />
    @else
        <x-modal-answer :question="$question" />
    @endif
@endsection
