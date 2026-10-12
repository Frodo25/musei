<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Экспонат музея</title>
</head>
<body>
    <h1>{{ $exhibit->name }}</h1>

    <p>
        <strong>Описание:</strong>
        {{ $exhibit->description }}
    </p>
    <p>
        <strong>Период:</strong>
        {{ $exhibit->year ?? 'Не указан' }}
    </p>

    <a href="/">На главную</a>
</body>
</html>
