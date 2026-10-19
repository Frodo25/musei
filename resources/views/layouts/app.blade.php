<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>


    <nav>
        <a href="{{ route('home') }}">Главная</a>
        <a href="{{ route('about') }}">О музее</a>
        <a href="{{ route('catalog') }}">Каталог</a>
        <a href="{{ route('contacts') }}">Контакты</a>
        <a href="{{ route('rules') }}">Правила</a>
    </nav>

    <main>
        @yield('content')
    </main>


    <footer>
        <p>&copy; {{ date('Y') }} Музей. Все права защищены.</p>
    </footer>

</body>
</html>