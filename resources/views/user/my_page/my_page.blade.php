@extends('layout.user')

@section('content')
    <x-page-title-cloud title="マイプロフィール" img_name="profile" />

    <div class="max-w-6xl px-4 mx-auto">
        <x-breadcrumb :items="[['マイプロフィール', route('user.my_page')]]" />
    </div>

    <div class="max-w-6xl px-4 mx-auto mb-10">
        <!-- プロフィール情報カード -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4 pb-3 border-b border-gray-200">プロフィール情報</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-600 mb-1">ユーザー名</label>
                    <span class="text-base text-gray-900 font-medium">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-600 mb-1">メールアドレス</label>
                    <span class="text-base text-gray-900 font-medium">{{ maskEmail(Auth::user()->email) }}</span>
                </div>
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-600 mb-1">ダイビングライセンス</label>
                    <span class="text-base text-gray-900 font-medium">{{ Auth::user()->license_label }}</span>
                </div>
            </div>
            <div class="mt-6 pt-4 border-t border-gray-200 flex justify-center">
                <a href="{{ route('user.register_edit', Auth::user()->id) }}"
                   class="bg-cyan-500 hover:bg-cyan-600 text-white font-bold py-2 px-6 rounded transition-colors duration-200">
                    プロフィールを編集
                </a>
            </div>
        </div>

        <!-- 最近の履歴 -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-900 mb-4">最近の履歴</h2>

            <!-- タブメニュー -->
            <div class="flex border-b border-gray-200 mb-6">
                <button id="questionsTab" class="py-3 px-6 text-gray-600 hover:text-cyan-600 focus:outline-none border-b-2 border-transparent transition-colors duration-200" onclick="changeTab('questions')">
                    質問
                </button>
                <button id="answersTab" class="py-3 px-6 text-gray-600 hover:text-cyan-600 focus:outline-none border-b-2 border-transparent transition-colors duration-200" onclick="changeTab('answers')">
                    回答
                </button>
                <button id="articlesTab" class="py-3 px-6 text-gray-600 hover:text-cyan-600 focus:outline-none border-b-2 border-transparent transition-colors duration-200" onclick="changeTab('articles')">
                    記事
                </button>
            </div>

            <!-- Tab Content -->
            <div id="questionsContent">
                @include('user.my_page.question', ['questions' => $questions])
            </div>
            <div id="answersContent" class="hidden">
                @include('user.my_page.answer', ['answers' => $answers])
            </div>
            <div id="articlesContent" class="hidden">
                @include('user.my_page.article', ['articles' => $article_reports])
            </div>
        </div>
    </div>

    <script>
        // タブを切り替える関数
        function changeTab(tabName) {
            // すべてのコンテンツを非表示にし、対象タブを表示
            const tabContents = ['questionsContent', 'answersContent', 'articlesContent'];
            tabContents.forEach(contentId => {
                const element = document.getElementById(contentId);
                if (contentId === `${tabName}Content`) {
                    element.classList.remove('hidden');
                } else {
                    element.classList.add('hidden');
                }
            });

            // タブメニューのスタイルを更新
            const tabButtons = ['questionsTab', 'answersTab', 'articlesTab'];
            tabButtons.forEach(buttonId => {
                const button = document.getElementById(buttonId);
                if (buttonId === `${tabName}Tab`) {
                    button.classList.add('text-cyan-600', 'font-semibold', 'border-cyan-600');
                    button.classList.remove('text-gray-600', 'border-transparent');
                } else {
                    button.classList.add('text-gray-600', 'border-transparent');
                    button.classList.remove('text-cyan-600', 'font-semibold', 'border-cyan-600');
                }
            });

            // URLパラメータを更新
            const url = new URL(window.location);
            url.searchParams.set('tab', tabName);
            window.history.pushState({}, '', url);
        }

        // ページ読み込み時に適切なタブを表示
        window.addEventListener('DOMContentLoaded', function() {
            const urlParams = new URLSearchParams(window.location.search);
            const tab = urlParams.get('tab') || 'questions';
            changeTab(tab);
        });
    </script>
@endsection
