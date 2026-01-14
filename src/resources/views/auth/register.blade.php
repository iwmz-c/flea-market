<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>coachtech market</title>
    <link rel="stylesheet" href="{{ asset('css/sanitize.css')}}">
    <link rel="stylesheet" href="{{ asset('css/common.css')}}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
</head>

<body>
    <div class="app">
        <header class="header">
            <a href="/">
                <img class="header-logo" src="{{ asset('img/logo.svg') }}" alt="COACHTECH">
            </a>
        </header>

        <div class="content">
            <div class="register-form">
                <h2 class="register-form__heading">会員登録</h2>
                <div class="register-form__inner">
                    <form class="register-form__form" action="/register" method="post" novalidate>
                        @csrf
                        <div class="register-form__group">
                            <label class="register-form__label" for="name">ユーザー名</label>
                            <input class="register-form__input" type="text" name="name">
                            <p class="register-form__error-message">
                                @error('name')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="register-form__group">
                            <label class="register-form__label" for="email">メールアドレス</label>
                            <input class="register-form__input" type="email" name="email">
                            <p class="register-form__error-message">
                                @error('email')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="register-form__group">
                            <label class="register-form__label" for="password">パスワード</label>
                            <input class="register-form__input" type="password" name="password">
                            <p class="register-form__error-message">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="register-form__group">
                            <label class="register-form__label" for="password">確認用パスワード</label>
                            <input class="register-form__input" type="password" name="password_confirmation">
                            <p class="register-form__error-message">
                                @error('password')
                                {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <input class="register-form__button" type="submit" value="登録する">
                    </form>
                </div>
                <div class="login__link">
                    <a class="login__button-submit" href="/login">ログインはこちら</a>
                </div>
            </div>
        </div>
    </div>
</body>