@extends('layouts.app')

@section('title', 'Каталог экспонатов')

@section('content')

    <h1>Каталог экспонатов музея</h1>
        <thead>
            <tr>
                <th>Название</th>
                <th>Автор</th>
                <th>Зал</th>
                <th>Год</th>
            </tr>
        </thead>
        <tbody>
            @forelse($exhibits as $exhibit)
            @empty
                <tr><td colspan="4">Экспонатов пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $exhibits->links() }}
    </div>
    @foreach($exhibits as $exhibit)
    <div class="exhibit-card">
        {{-- Проверяем, загружена ли обложка --}}
        @if($exhibit->cover)
            {{-- Выводим картинку через asset и публичную ссылку storage --}}
            <img src="{{ asset('storage/' . $exhibit->cover) }}" alt="{{ $exhibit->title }}" width="200">
        @else
            <img src="{{ asset('images/no-image.png') }}" alt="Нет фото" width="200">
        @endif

        <h3>{{ $exhibit->title }}</h3>
        <p>Автор: {{ $exhibit->author }}</p>
    </div>
    @endforeach
@endsection