<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ __('messages.exhibit') }}</title>
</head>
<body>
    <nav>
        <a href="{{ route('home') }}">{{ __('messages.home') }}</a> |
        <a href="{{ route('about') }}">{{ __('messages.about') }}</a> |
        <a href="{{ route('contacts') }}">{{ __('messages.contacts') }}</a> |
        <a href="{{ route('catalog') }}">{{ __('messages.catalog') }}</a>
    </nav>

    <!-- Кнопки смены языка -->
    <div style="margin: 10px 0;">
        <a href="{{ route('locale', 'ru') }}">RU</a> | 
        <a href="{{ route('locale', 'kk') }}">KK</a> | 
        <a href="{{ route('locale', 'en') }}">EN</a>
    </div>

    <h1>{{ __('messages.exhibit_title', ['id' => $id]) }}</h1>
    <p>{{ __('messages.exhibit_desc_' . $id) }}</p>
</body>
</html>