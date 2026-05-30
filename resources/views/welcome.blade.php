<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @auth
        @include('layouts.navigation')
        <form id="logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
        </form>
        <a
            href="{{ route('logout') }}"
            dusk="logout"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
        >
            Logout
        </a>
    @endauth
    <div class="container mx-auto py-4">
        <h1>Привет от Хекслета!</h1>
    </div>
</body>
</html>
