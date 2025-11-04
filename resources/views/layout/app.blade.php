<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta http-equiv="content-language" content="ja">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DIVE HUB ~ダイビング情報共有サイト~</title>
    <link rel="icon" href="{{ asset('OGP_icon.ico') }}" type="image/x-icon">
    <meta name="description" content="ダイビングに関する質問や情報を共有するためのフォーラムです。初心者から経験者まで、皆様のダイビング体験をシェアし、学び合いましょう。最新のダイビングスポット情報や器材のレビュー、スキル向上のためのヒントなど、多彩なコンテンツを提供します。">
    <meta name="keywords" content="ダイビング, 質問, フォーラム, DIVE HUB, スキューバダイビング, ダイビング SNS, ダイビング 質問, ダイビングWEBアプリ">
    <meta name="robots" content="index, follow">
    <meta property="og:title" content="DIVE HUB ~ダイビング情報共有サイト~" />
    <meta property="og:description" content="ダイビングに関する質問や情報を共有するためのフォーラムです。初心者から経験者まで、皆様のダイビング体験をシェアし、学び合いましょう。" />
    <meta property="og:image" content="{{ asset('images/OGP_icon.jpeg') }}" />
    <meta property="og:url" content="https://divehub.jp/" />
    <meta property="og:type" content="website" />
    <meta name="twitter:title" content="DIVE HUB ~ダイビング情報共有サイト~" />
    <meta name="twitter:description" content="ダイビングに関する質問や情報を共有するためのフォーラムです。初心者から経験者まで、皆様のダイビング体験をシェアし、学び合いましょう。" />
    <meta name="twitter:image" content="{{ asset('images/OGP_icon.jpeg') }}" />
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@Divehub_web" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script type="application/ld+json">
        {
            "@context": "http://schema.org",
            "@type": "WebSite",
            "name": "DIVE HUB",
            "url": "",
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://yourdomain.com/search?q={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    <!-- Google analytics (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-RPKQ5YBD9C"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'G-RPKQ5YBD9C');
    </script>
    <!-- Google Adsence -->
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-2394713630447930"
    crossorigin="anonymous"></script>
    <!-- Styles -->
    @vite('resources/css/app.css')
    @yield('styles')
</head>
@yield('body')

</html>
