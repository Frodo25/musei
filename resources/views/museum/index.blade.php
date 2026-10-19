@extends('layouts.app')

@section('title', 'Каталог экспонатов')

@section('content')
    <h1>Каталог экспонатов музея</h1>

    <div class="exhibits-grid">
        @foreach($items as $id => $item)
            <div class="exhibit-card">
                <h3>{{ $item['title'] ?? 'Без названия' }}</h3>
                <p><strong>Автор:</strong> {{ $item['author'] ?? 'Неизвестен' }}</p>
                <p><strong>Год:</strong> {{ $item['year'] ?? 'Н/Д' }}</p>
                <a href="{{ route('catalog.show', $id) }}" class="btn">Подробнее</a>
            </div>
        @endforeach
    </div>
@endsection