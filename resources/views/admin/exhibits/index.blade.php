@extends('layouts.app')

@section('title', __('Exhibits list (Admin Panel)'))

@section('content')
    <h1>{{ __('Список экспонатов') }}</h1>
    
    <div style="margin: 15px 0;">
        <a href="{{ route('admin.exhibits.create') }}" style="padding: 8px 14px; background: #2b6cb0; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">+ {{ __('Добавить Экспонат') }}</a>
    </div>

    <table border="1" cellpadding="8" style="width:100%; margin-top:15px; border-collapse:collapse;">
        <thead>
            <tr>
                <th>Id</th>
                <th>{{ __('Название') }}</th>
                <th>{{ __('Автор') }}</th>
                <th>{{ __('Зал') }}</th>
                <th>{{ __('Год') }}</th>
                <th>{{ __('Действия') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($exhibits as $exhibit)
                <tr>
                    <td>{{ $exhibit->id }}</td>
                    <td>{{ $exhibit->title }}</td>
                    <td>{{ $exhibit->author }}</td>
                    <td>{{ $exhibit->hall->name ?? __('Without hall') }}</td>
                    <td>{{ $exhibit->year }}</td>
                    <td>
                        <div style="display: flex; gap: 8px; align-items: center;">
                            <!-- Кнопка Изменить -->
                            <a href="{{ route('admin.exhibits.edit', $exhibit) }}" style="padding: 5px 10px; background: #d69e2e; color: white; text-decoration: none; border-radius: 4px; font-size: 13px;">{{ __('Edit') }}</a>
                            
                            <!-- Кнопка Удалить -->
                            <form method="POST" action="{{ route('admin.exhibits.destroy', $exhibit) }}" 
                                  style="display:inline; margin:0;" onsubmit="return confirm('{{ __('Are you sure you want to delete this exhibit?') }}')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="padding: 5px 10px; background: #e53e3e; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 13px;">{{ __('Delete') }}</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" style="text-align: center; color: #718096;">{{ __('Экспонатов не найдено') }}</td></tr>
            @endforelse
        </tbody>
    </table>

    <div style="margin-top: 15px;">
        {{ $exhibits->links() }}
    </div>

    <div style="margin-top: 20px; display: flex; gap: 10px; align-items: center;">
        <!-- Кнопка управления залами -->
        <a href="{{ route('admin.halls.index') }}" style="padding: 8px 14px; background: #319795; color: white; text-decoration: none; border-radius: 5px; display: inline-block;">{{ __('Управлять Залами') }}</a>
        
        <!-- Кнопка назад -->
        <a href="javascript:history.back()" style="padding: 8px 14px; background: #e2e8f0; color: #4a5568; text-decoration: none; border-radius: 5px; display: inline-block;">← {{ __('Назад') }}</a>
    </div>
@endsection