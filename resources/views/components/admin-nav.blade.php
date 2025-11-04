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


<nav class="bg-slate-900 fixed w-56 flex flex-col h-[100vh] px-2 text-slate-200 tracking-wide overflow-y-auto">
    <div class="px-4 pt-1 py-4 my-4 border-b-2 border-cyan-600">
        <a class="items-baseline block" href="{{ route('admin.dashboard') }}">
            <span class="text-xl font-medium">DIVE HUB<br>管理システム</span>
        </a>
    </div>

    <ul class="flex-1 py-2 px-2">
        @foreach ($nav_list as $array)
            <?php
            [$label, $path] = $array;
            $text_style = '';
            if (strpos(request()->url(), $path) !== false) {
                $text_style = 'text-emerald-400';
            }
            ?>
            <li class="hover:bg-white/10 rounded">
                <a class="p-2 block text-md font-medium {{ $text_style }}"
                    href="{{ $path }}">{{ $label }}</a>
            </li>
        @endforeach

        <li class="hover:bg-white/10 rounded">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="button" class="text-md font-medium p-2 block" href="{{ route('admin.logout') }}"
                    onclick="confirm('ログアウトしますか？') && submit()">
                    ログアウト
                </button>
            </form>
        </li>
    </ul>
</nav>
