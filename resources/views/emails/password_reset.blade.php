<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>パスワードリセットのお知らせ - Dive Hub</title>
    <style>
        .button {
            display: inline-block;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            background-color: #0073e6;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            margin-top: 20px;
        }
        .footer-text {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <p>この度は <strong>Dive Hub</strong> をご利用いただきありがとうございます。</p>
    <p>以下のリンクをクリックして、パスワードリセットを完了してください。</p>

    <a href="{{ $resetUrl }}" class="button">パスワードをリセットする</a>

    <p>※このリンクは60分間有効です。</p>

    <hr>

    <p class="footer-text">
        このメールは、Dive Hub ダイビング情報共有サイトでのパスワードリセットをリクエストした場合に送信されています。<br>
        万が一、心当たりがない場合はこのメールを破棄してください。
    </p>
</body>
</html>
