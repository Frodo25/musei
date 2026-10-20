@extends('layouts.app')

@section('title', 'Управление залами')

@section('content')
    <h1>Список залов</h1>
    
    <div style="margin: 15px 0;">
        <a href="{{ route('admin.halls.create') }}" style="padding: 8px 12px; background: #2b6cb0; color: white; text-decoration: none; border-radius: 5px;">+ Добавить зал</a>
    </div>

    <table border="1" cellpadding="8" style="width:100%; margin-top:15px; border-collapse:collapse;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Название зала</th>
                <th>Кол-во экспонатов</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse($halls as $hall)
                <tr>
                    <td>{{ $hall->id }}</td>
                    <td>{{ $hall->name }}</td>
                    <td>{{ $hall->exhibits_count }}</td>
                    <td>
                        <a href="{{ route('admin.halls.edit', $hall) }}">Изменить</a>
                        <form method="POST" action="{{ route('admin.halls.destroy', $hall) }}" 
                              style="display:inline;" onsubmit="return confirm('Удалить этот зал?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: red; background: none; border: none; cursor: pointer; padding: 0; text-decoration: underline;">Удалить</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr><td colspan="4">Залов пока нет</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $halls->links() }}
    </div>

    <div style="margin-top: 20px;">
        <a href="{{ route('admin.exhibits.index') }}">← Вернуться к экспонатам</a>
    </div>
@endsection