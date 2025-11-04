<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>認証コードのお知らせ - Dive Hub</title>
    <style>
        .code-box {
            font-size: 24px;
            font-weight: bold;
            color: #0073e6;
            padding: 10px;
            border: 2px solid #0073e6;
            border-radius: 8px;
            display: inline-block;
            margin-top: 10px;
        }
        .footer-text {
            font-size: 12px;
            color: #555;
        }
    </style>
</head>
<body>
    <p>この度は <strong>DIve Hub</strong> にご登録いただき、ありがとうございます。</p>
    <p>以下の認証コードを入力し、会員登録を完了してください。</p>

    <p>認証コード：</p>
    <div class="code-box">{{ $authCode }}</div>

    <p>※15分以内にコードを入力してください。</p>

    <hr>

    <p class="footer-text">
        このメールは、DIve Hub ダイビング情報共有サイトでの認証を行うために送信されています。<br>
        万が一、身に覚えがない場合はこのメールを破棄してください。
    </p>
</body>
</html>
