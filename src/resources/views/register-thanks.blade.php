<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register-thanks.css') }}">
</head>
<body>
        <div class="thanks_main">
            <div class="thanks_title">
                Rese
            </div>
            <div class="thanks_content">
                <div class="thanks_message">
                    会員登録ありがとうございます
                </div>
            </div>
        </div>
        <p>
                メールを受信していない方は下記のリンクで再送信をお願いします。
                    <form method="POST" action="{{ route('verification.send') }}" style="display:inline;">
                    @csrf
                        <button type="submit">
                            メールの再送信
                        </button>
                    </form>
            </p>
            @if (session('message'))
                <div>
                    {{ session('message') }}
                </div>
            @endif
</body>
</html>

