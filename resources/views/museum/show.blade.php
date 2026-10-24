<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $item['title'] }}</title>
</head>
<body>
    <h1>{{ $item['title'] }}</h1>
    <p><strong>Автор / Происхождение:</strong> {{ $item['author'] }}</p>
    <p><strong>Год создания:</strong> {{ $item['year'] }}</p>

    <p style="margin-top: 20px;">
        <a href="{{ route('museum.index') }}">← Назад к списку экспонатов</a>
    </p>
</body>
</html>