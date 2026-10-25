<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
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

    <nav style="margin-bottom: 20px;">
        <a href="{{ route('home') }}">{{ __('Главная') }}</a>
        <a href="{{ route('about') }}">{{ __('О музее') }}</a>
        <a href="{{ route('catalog') }}">{{ __('Каталог') }}</a>
        <a href="{{ route('contacts') }}">{{ __('Контакты') }}</a>
        <a href="{{ route('rules') }}">{{ __('Правила') }}</a>
        <a href="{{ route('locale', 'ru') }}" @if(app()->getLocale() == 'ru') style="font-weight: bold;" @endif>RU</a> | 
        <a href="{{ route('locale', 'kk') }}" @if(app()->getLocale() == 'kk') style="font-weight: bold;" @endif>ҚАЗ</a> | 
        <a href="{{ route('locale', 'en') }}" @if(app()->getLocale() == 'en') style="font-weight: bold;" @endif>EN</a>
    </nav>

    <div class="container">
        {{-- Уведомления об успехе/ошибках --}}
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

        {{-- Основной контент (вызывается ровно один раз) --}}
        <main>
            @yield('content')
        </main>
    </div>
<div class="mt-4">
    <h3 class="font-bold">{{ __('Уведомления:') }}</h3>
    <ul>
        <li>{{ __('Войдите, чтобы видеть уведомления') }}</li>
    </ul>
</div>
</body>
</html>