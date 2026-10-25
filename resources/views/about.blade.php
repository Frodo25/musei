@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <h1>{{ __('Контакты') }}</h1>
    <p><strong>Адрес:</strong> {{ __('г. Музейный, ул. Экспонатная, 10') }}</p>
    <p><strong>Телефон:</strong> {{ __('+7 (123) 456-78-90') }}</p>
    <p><strong>Email:</strong> {{ __('info@museum.local') }}</p>
@endsection

