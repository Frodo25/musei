
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>О музее</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">Главная</a> |
        <a href="{{ route('about') }}">О музее</a> |
        <a href="{{ route('contacts') }}">Контакты</a> |
        <a href="{{ route('catalog') }}">Каталог</a> |
        <a href="{{ route('exhibits.show', ['id' => 1]) }}">Экспонат №1</a> |
        <a href="{{ route('exhibits.show', ['id' => 2]) }}">Экспонат №2</a> |
        <a href="{{ route('exhibits.show', ['id' => 3]) }}">Экспонат №3</a>
    </nav>
    <h1>О музее</h1>
    <p>Музей крутой</p>
    <a href="/">На главную</a>
</body>
</html>
