<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Каталог музея</title>
</head>
<body>
    <h1>Каталог экспонатов</h1>
    <ul>
        @foreach ($items as $id => $item)
            <li>
                <a href="{{ route('exhibits.show', ['id' => $id]) }}">{{ $item['title'] }}</a>
            </li>
        @endforeach
    </ul>
    <p><a href="{{ route('home') }}">← На главную</a></p>
</body>
</html>