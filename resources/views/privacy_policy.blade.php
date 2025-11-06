@extends('layout.user')

@section('content')
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="relative bg-white rounded-md border border-gray-300 p-6">
            <h1 class="text-2xl font-bold mb-4">プライバシーポリシー</h1>
        <p class="mb-4">本プライバシーポリシーは、DIVE HUB〜ダイビング情報共有サイト〜（以下、「当サイト」）が収集、使用、および共有する個人情報についての方針を説明するものです。当サイトをご利用いただく際には、本プライバシーポリシーに同意いただいたものとみなします。</p>

        <h2 class="text-xl font-semibold mb-2">1. 収集する情報</h2>
        <p class="mb-4">当サイトでは、以下の情報を収集する場合があります。</p>
        <ul class="list-disc pl-6 mb-4">
            <li>氏名、メールアドレス、電話番号などの連絡先情報</li>
            <li>ユーザー名、パスワードなどの認証情報</li>
            <li>サービス利用履歴、アクセスログ、IPアドレスなどの技術情報</li>
            <li>その他ユーザーが提供する情報</li>
        </ul>

        <h2 class="text-xl font-semibold mb-2">2. 情報の利用目的</h2>
        <p class="mb-4">当サイトは、収集した情報を以下の目的で利用します。</p>
        <ul class="list-disc pl-6 mb-4">
            <li>サービスの提供および運営</li>
            <li>ユーザーサポートの提供</li>
            <li>サービス向上のための分析および研究</li>
            <li>マーケティングおよび広告の提供</li>
            <li>法的義務の遵守</li>
        </ul>

        <h2 class="text-xl font-semibold mb-2">3. 情報の共有</h2>
        <p class="mb-4">当サイトは、ユーザーの同意を得た場合、または法令に基づく場合を除き、個人情報を第三者と共有しません。</p>

        <h2 class="text-xl font-semibold mb-2">4. 情報の保護</h2>
        <p class="mb-4">当サイトは、個人情報の漏洩、紛失、改ざん、不正アクセスを防止するために、適切なセキュリティ対策を講じます。</p>

        <h2 class="text-xl font-semibold mb-2">5. ユーザーの権利</h2>
        <p class="mb-4">ユーザーは、自己の個人情報の開示、訂正、削除を求める権利があります。これらの権利を行使する場合は、当サイトのサポートチームまでご連絡ください。</p>

        <h2 class="text-xl font-semibold mb-2">6. クッキー（Cookie）について</h2>
        <p class="mb-4">当サイトは、ユーザーの利便性向上および利用状況の分析のためにクッキーを使用することがあります。クッキーの使用を拒否する場合は、ブラウザの設定を変更してください。</p>

        <h2 class="text-xl font-semibold mb-2">7. プライバシーポリシーの変更</h2>
        <p class="mb-4">当サイトは、必要に応じて本プライバシーポリシーを変更することがあります。変更後のポリシーは、当サイトに掲載された時点で効力を生じます。</p>

        <h2 class="text-xl font-semibold mb-2">8. お問い合わせ</h2>
        <p class="mb-4">プライバシーポリシーに関するお問い合わせは、以下のリンクでお願いいたします。</p>
        <a href="{{ route('inquiry') }}" class="text-blue-700 hover:text-blue-900 transition duration-300">お問い合わせ</a>
        </div>
    </div>
@endsection
