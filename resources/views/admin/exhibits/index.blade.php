@extends('layouts.app')

@section('title', 'Список экспонатов (Админ-панель)')

@section('content')
    <h1>Список экспонатов (Админ-панель)</h1>
    
    <!-- Кнопка добавления нового экспоната -->
    <div style="margin: 15px 0;">
        <a href="{{ route('admin.exhibits.create') }}" style="padding: 8px 12px; background: #2b6cb0; color: white; text-decoration: none; border-radius: 5px;">+ Добавить экспонат</a>
    </div>

    <table border="1" cellpadding="8" style="width:100%; margin-top:15px; border-collapse:collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Автор</th>
                <th>Зал</th>
                <th>Год</th>
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
                    <td>
                        <a href="{{ route('admin.exhibits.edit', $exhibit) }}">Изменить</a>
                        <form method="POST" action="{{ route('admin.exhibits.destroy', $exhibit) }}" 
                              style="display:inline;" onsubmit="return confirm('Удалить этот экспонат?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer; padding: 0; text-decoration: underline;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6">Экспонатов пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $exhibits->links() }}
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('admin.halls.index') }}">Управление залами (связанная сущность)</a>
    </div>

    <div style="margin-top: 10px;">
        <a href="javascript:history.back()">← Назад в админку</a>
    </div>
@endsection