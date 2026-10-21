@extends('layouts.app')

@section('title', 'Каталог экспонатов')

@section('content')
    <h1>Каталог экспонатов музея</h1>

    <table border="1" cellpadding="8" style="width:100%; margin-top:15px; border-collapse:collapse;">
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
                <tr>
                    <td>{{ $exhibit->title }}</td>
                    <td>{{ $exhibit->author }}</td>
                    <td>{{ $exhibit->hall->name ?? 'Без зала' }}</td>
                    <td>{{ $exhibit->year }}</td>
                </tr>
            @empty
                <tr><td colspan="4">Экспонатов пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $exhibits->links() }}
    </div>
@endsection