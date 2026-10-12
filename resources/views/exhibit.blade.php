<!DOCTYPE html>
<html lang="ru">
<head><meta charset="UTF-8"><title>Экспонат</title></head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О проекте</a> |
        <a href="{{ route('contacts') }}">Контакты</a>
    </nav>
    <h1>Экспонат №{{ $id }}</h1>
    <p>Подробная информация об историческом экспонате под номером {{ $id }}.</p>
</body>
</html>