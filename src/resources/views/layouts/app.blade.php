<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rese</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css') }}">
    <link rel="stylesheet" href="{{ asset('css/common.css') }}">
    @yield('css')
</head>

<body>
    <header class="header">
    <div class="header__inner">
        <div class="header-utilities">
            <div class="hamburger">
                <div class="hamburger-menu">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
            </div>
            {{-- <i class="fa-solid fa-square-poll-vertical fa-rotate-90" style="color: blue; font-size:50px; "></i> --}}
            <div class="header__logo" href="/">
                Rese
            </div>
            <form class="form" action="/logout" method="post">
            @csrf
                <button class="header-nav__button">
                    ログアウト
                </button>
            </form>
        </div>
    </div>
    </header>
    <main>
        @yield('content')
    </main>
</body>

</html>
