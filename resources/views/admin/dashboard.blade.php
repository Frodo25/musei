<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Панель администратора</title>
</head>
<body>
    <p>Добро пожаловать в закрытый раздел!</p>
</body>

@section('title', 'Главная панель администратора')

@section('content')
    <h1>Панель управления музеем</h1>

    <div style="display: flex; gap: 20px; margin-top: 20px;">
        <div style="flex: 1; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <h2>🏛 Экспонаты</h2>
            <p>Управление экспонатами музея, добавление, редактирование и удаление.</p>
            <a href="{{ route('admin.exhibits.index') }}" class="btn">Перейти к экспонатам →</a>
        </div>

        <div style="flex: 1; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <h2>Залы музея</h2>
            <p>Управление залами и выставочными пространствами.</p>
            <a href="{{ route('admin.halls.index') }}" class="btn">Перейти к залам →</a>
        </div>
        <div style="flex: 1; padding: 20px; border: 1px solid #e2e8f0; border-radius: 8px; background: #f8fafc;">
            <a href="{{ route('admin.logout') }}" class="btn">Выйти из профиля администратора</a>
        </div>
    </div>
@endsection
</html>