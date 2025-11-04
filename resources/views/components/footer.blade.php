<footer class="bg-gradient-to-r from-cyan-800 to-blue-900 text-white py-6 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 flex flex-col md:flex-row items-center justify-between">
        <div class="flex flex-col items-center md:items-start mb-6 md:mb-0">
            <div class="flex items-center">
                <img src="{{ asset('images/icons/icon_dive.svg') }}" alt="Dive Icon" class="w-6 h-6 md:w-8 md:h-8 mr-2 filter brightness-0 invert">
                <h1 class="text-white text-lg md:text-2xl font-bold">DIVE HUB</h1>
            </div>
            <span class="text-cyan-100 text-xs md:text-sm mt-1">ダイビング情報共有サイト</span>
        </div>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:flex md:flex-row gap-4 md:gap-6 text-center md:text-right text-sm md:text-base">
            @guest
                <a href="{{ route('user.register') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">会員登録</a>
            @endguest
            <a href="{{ route('user.login') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">ログイン</a>
            <a href="{{ route('inquiry') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">お問い合わせ</a>
            <a href="{{ route('privacy_policy') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">プライバシー<br>ポリシー</a>
            <a href="{{ route('terms_of_service') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">利用規約</a>
            @auth
                <a href="{{ route('user.retire') }}" class="text-cyan-100 hover:text-white transition duration-300 hover-lift">退会</a>
            @endauth
        </div>
    </div>
    <div class="max-w-7xl mx-auto px-4 mt-6 pt-4 border-t border-cyan-700">
        <p class="text-center text-cyan-200 text-xs md:text-sm">&copy; {{ date('Y') }} DIVE HUB. All rights reserved.</p>
    </div>
</footer>
