<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <h1>Привет от Хекслета!</h1>

    @auth
        <a href="{{ route('dashboard') }}">Dashboard</a>
    @else
        <a href="{{ route('login') }}">Вход</a>

        @if (Route::has('register'))
            <a href="{{ route('register') }}">Регистрация</a>
        @endif
    @endauth
</body>
</html>
