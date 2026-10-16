<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Админка: Экспонаты</title>
</head>
<body>
    <h1>Список экспонатов (Админ-панель)</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th>
            <th>Название</th>
            <th>Автор</th>
            <th>Год</th>
        </tr>
        @foreach ($items as $id => $item)
        <tr>
            <td>{{ $id }}</td>
            <td>{{ $item['title'] }}</td>
            <td>{{ $item['author'] }}</td>
            <td>{{ $item['year'] }}</td>
        </tr>
        @endforeach
    </table>
    <p style="margin-top: 20px;">
        <a href="{{ route('admin.dashboard') }}">← Назад в админку</a>
    </p>
</body>
</html>