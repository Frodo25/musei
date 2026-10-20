<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <nav style="display: flex; justify-content: space-between; align-items: center; padding: 12px 20px; background: #ffffff; border-bottom: 2px solid #edf2f7; margin-bottom: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
    {{-- Название и логотип музея --}}
    <div>
        <a href="{{ route('admin.exhibits.index') }}" style="font-weight: bold; font-size: 1.1em; color: #2b6cb0; text-decoration: none;">
            🏛 Музей
        </a>
    </div>

    {{-- Меню входа / регистрации / профиля --}}
    <div style="display: flex; align-items: center; gap: 15px;">
        @guest
            <a href="{{ route('login') }}" style="color: #4a5568; text-decoration: none; font-weight: 500;">
                🔑 Вход
            </a>
            <a href="{{ route('register') }}" class="btn" style="padding: 6px 14px; font-size: 0.9em;">
                📝 Регистрация
            </a>
        @endguest

        @auth
            <span style="color: #4a5568;">
                Вы вошли как: <strong>{{ auth()->user()->name }}</strong> 
                <span style="background: #e2e8f0; color: #2d3748; padding: 2px 8px; border-radius: 12px; font-size: 0.8em; margin-left: 4px;">
                    {{ auth()->user()->role }}
                </span>
            </span>

            @can('admin-panel')
                <a href="{{ route('admin.exhibits.index') }}" style="color: #2b6cb0; text-decoration: none; font-weight: 600;">
                    ⚙️ Админ-панель
                </a>
            @endcan

            <form method="POST" action="{{ route('logout') }}" style="display: inline; margin: 0;">
                @csrf
                <button type="submit" style="background: none; border: none; color: #e53e3e; cursor: pointer; text-decoration: underline; font-family: inherit; font-size: 1em;">
                    Выйти
                </button>
            </form>
        @endauth
    </div>
</nav>


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
    <div class="container">
        @if (session('success'))
            <div style="background-color: #c6f6d5; color: #22543d; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div style="background-color: #fed7d7; color: #742a2a; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
                {{ session('error') }}
            </div>
        @endif

        @yield('content')
    </div>
</body>
</html>