@extends('layouts.app')

@section('title', 'Управление экспонатами')

@section('content')
    <h1>Список экспонатов</h1>
    <a href="{{ route('admin.exhibits.create') }}">Добавить экспонат</a>

    <table border="1" cellpadding="8" style="width:100%; margin-top:15px; border-collapse:collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Зал</th>
                <th>Год</th>
                <th>Дата создания</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($exhibits as $exhibit)
                <tr>
                    <td>{{ $exhibit->id }}</td>
                    <td>{{ $exhibit->title }}</td>
                    <td>{{ $exhibit->author }}</td>
                    <td>{{ $exhibit->hall->name ?? 'Без зала' }}</td>
                    <td>{{ $exhibit->year }}</td>
                    <td>{{ $exhibit->created_at->format('d.m.Y') }}</td>
                    <td>
                        <a href="{{ route('admin.exhibits.edit', $exhibit) }}">Изменить</a>
                        <form method="POST" action="{{ route('admin.exhibits.destroy', $exhibit) }}" 
                              style="display:inline;" onsubmit="return confirm('Удалить экспонат?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="7">Экспонатов пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $exhibits->links() }}
    </div>
@endsection