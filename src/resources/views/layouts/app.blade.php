<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>coachtech market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    @yield('css')
    @livewireStyles
</head>

<body>
    <div class="app">
        <header class="header">
            <div class="header-left">
                <a href="/">
                    <img class="header-logo" src="{{ asset('img/logo.svg') }}" alt="COACHTECH">
                </a>
            </div>

            <div class="header-center">
                <form class="search-form" method="GET" action="{{ url('/') }}">
                    @csrf
                    <input class="search-form__input" type="text" name="keyword" value="{{ request('keyword') }}" placeholder="なにをお探しですか？">
                </form>
            </div>

            <div class="header-right">
                <ul class="header-nav">
                    @if(Auth::check())
                        <li class="header-nav__item">
                            <form class="form" action="/logout" method="post">
                                @csrf
                                <button class="header-nav__button">ログアウト</button>
                            </form>
                        </li>
                    @else
                        <li class="header-nav__item">
                            <a class="header-nav__link" href="/login">ログイン</a>
                        </li>
                    @endif

                    <li class="header-nav__item">
                        <a class="header-nav__link" href="/mypage">マイページ</a>
                    </li>
                    <li class="header-nav__item">
                        <a class="header-nav__link--sell" href="/sell">出品</a>
                    </li>
                </ul>
            </div>
            @yield('nav')
        </header>
        <div class="content">
            @yield('content')
        </div>
    </div>
@livewireScripts
</body>

</html>