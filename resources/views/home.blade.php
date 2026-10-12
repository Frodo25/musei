<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О музее</a> |
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <h1>Добро пожаловать</h1>
    <p>Это музей жоский</p>
</body>
</html>