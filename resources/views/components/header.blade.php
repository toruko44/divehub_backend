<header class="glass w-full fixed top-0 z-50 shadow-lg backdrop-blur-lg bg-white bg-opacity-80">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center p-4 md:justify-center">
            <a href="{{ route('top') }}" class="flex items-center hover-lift">
                <img src="{{ asset('images/icons/icon_dive.svg') }}" alt="Dive Icon" class="w-12 h-12">
                <div class="flex flex-col ml-3">
                    <h1 class="text-cyan-900 text-3xl font-bold">DIVE HUB</h1>
                    <span class="text-cyan-700 text-sm">ダイビング情報共有サイト</span>
                </div>
            </a>
            <div class="sm:hidden">
                <button id="menu-toggle" class="focus:outline-none focus:ring-2 focus:ring-cyan-500 rounded-md p-1" aria-label="メニューを開く">
                    <svg class="w-7 h-7 text-cyan-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>
        <hr class="border-cyan-500 opacity-30">
        <div id="menu" class="hidden sm:flex flex-col sm:flex-row justify-center items-center py-3 bg-white bg-opacity-80 backdrop-blur-md w-full">
            <ul class="flex flex-col sm:flex-row gap-4 text-gray-800 w-full sm:w-auto px-0 sm:px-6">
                <div class="grid gap-4 w-full sm:flex sm:flex-row">
                    <li class="mx-2 ld:mx-4 flex relative group">
                        <a href="{{ route('top') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Route::currentRouteName() === 'top' ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                            <img src="{{ asset('images/icons/icon_dive.svg') }}" alt="Profile Icon" class="w-6 h-6 mr-2">
                            トップ
                            <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="mx-2 ld:mx-4 flex relative group">
                            <a href="{{ route('user.my_page') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Route::currentRouteName() === 'user.my_page' ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                                <img src="{{ asset('images/icons/icon_profile.svg') }}" alt="Profile Icon" class="w-6 h-6 mr-2">
                                マイプロフィール
                                <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                            </a>
                        </li>
                    @endif
                    <li class="mx-2 ld:mx-4 flex relative group">
                        <a href="{{ route('user.question_box.index') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Str::contains(Route::currentRouteName(), 'question_box') ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                            <img src="{{ asset('images/icons/icon_board.svg') }}" alt="Board Icon" class="w-6 h-6 mr-2">
                            質問箱
                            <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li class="mx-2 ld:mx-4 flex relative group">
                        <a href="{{ route('user.article.index') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Str::contains(Route::currentRouteName(), 'article') ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                            <img src="{{ asset('images/icons/icon_article.svg') }}" alt="Board Icon" class="w-6 h-6 mr-2">
                            ダイビング記事
                            <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    <li class="mx-2 ld:mx-4 flex relative group">
                        <a href="{{ route('news.index') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Str::contains(Route::currentRouteName(), 'news') ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                            </svg>
                            お知らせ
                            <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                        </a>
                    </li>
                    @if (Auth::check())
                        <li class="mx-2 ld:mx-4 flex relative group">
                            <a href="#" id="logout-link" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base">
                                <img src="{{ asset('images/icons/icon_logout.svg') }}" alt="Logout Icon" class="w-6 h-6 mr-2">
                                ログアウト
                                <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                            </a>
                            <form action="{{ route('user.logout') }}" method="POST" id="logout-form" class="hidden">
                                @csrf
                            </form>
                        </li>
                    @else
                        <li class="mx-2 ld:mx-4 flex relative group">
                            <a href="{{ route('user.login') }}" class="relative py-2 px-6 text-gray-800 no-underline group-hover:text-cyan-600 flex items-center text-xs sm:text-sm md:text-base {{ Str::contains(Route::currentRouteName(), 'login') ? 'text-cyan-600 font-bold active-link no-animation' : 'text-gray-800' }}">
                                <img src="{{ asset('images/icons/icon_login.svg') }}" alt="Login Icon" class="w-6 h-6 mr-2">
                                ログイン
                                <span class="absolute bottom-0 left-0 right-0 w-full h-0.5 bg-cyan-600 transform scale-x-0 transition-transform duration-300 origin-center group-hover:scale-x-100"></span>
                            </a>
                        </li>
                    @endif
                </div>
            </ul>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var menuToggle = document.getElementById('menu-toggle');
        var menu = document.getElementById('menu');
        var logoutLink = document.getElementById('logout-link');
        var logoutForm = document.getElementById('logout-form');

        if (menuToggle) {
            menuToggle.addEventListener('click', function () {
                if (menu.classList.contains('hidden')) {
                    menu.classList.remove('hidden');
                    menu.classList.add('flex', 'flex-col');
                    menuToggle.setAttribute('aria-label', 'メニューを閉じる'); // ラベルを更新
                } else {
                    menu.classList.remove('flex', 'flex-col');
                    menu.classList.add('hidden');
                    menuToggle.setAttribute('aria-label', 'メニューを開く'); // ラベルを更新
                }
            });
        }

        if (logoutLink && logoutForm) {
            logoutLink.addEventListener('click', function(event) {
                event.preventDefault();
                logoutForm.submit();
            });
        }
    });
</script>
