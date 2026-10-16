<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
    <h1>Панель администратора музея</h1>
    <p>Добро пожаловать в закрытый раздел!</p>
    <ul>
        <li><a href="{{ route('admin.museum') }}">Управление экспонатами</a></li>
        <li><a href="{{ route('admin.logout') }}">Выйти из админки</a></li>
    </ul>
    <p><a href="{{ route('home') }}">← На главную сайт</a></p>
</body>
</html>