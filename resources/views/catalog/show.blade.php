<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $exhibit->title }} — Музей</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="bg-light">
    <div class="container my-5">
        <div class="mb-3">
            <a href="{{ route('home') }}" class="btn btn-secondary">&larr; На главную</a>
        </div>

        <div class="card shadow-sm">
            <div class="row g-0">
                {{-- Колонка с изображением (обложкой) --}}
                <div class="col-md-5 bg-white d-flex align-items-center justify-content-center p-3">
                    @if($exhibit->cover)
                        <img src="{{ asset('storage/' . $exhibit->cover) }}" alt="{{ $exhibit->title }}" class="img-fluid rounded" style="max-height: 400px; object-fit: cover;">
                    @else
                        <div class="text-muted p-5 border rounded w-100 text-center bg-light">Нет изображения</div>
                    @endif
                </div>

                {{-- Колонка с информацией об экспонате --}}
                <div class="col-md-7">
                    <div class="card-body p-4">
                        <h1 class="card-title mb-3">{{ $exhibit->title }}</h1>
                        
                        <p class="text-muted mb-2">
                            <strong>Автор:</strong> {{ $exhibit->author ?? 'Не указан' }}
                        </p>
                        
                        <p class="text-muted mb-2">
                            <strong>Год создания:</strong> {{ $exhibit->year }}
                        </p>

                        @if($exhibit->hall)
                            <p class="text-muted mb-3">
                                <strong>Зал музея:</strong> {{ $exhibit->hall->name }}
                            </p>
                        @endif

                        <hr>

                        <h5 class="mt-4">Описание:</h5>
                        <p class="card-text text-secondary" style="white-space: pre-line;">
                            {{ $exhibit->description ?? 'Описание отсутствует.' }}
                        </p>

                        {{-- Ссылка на дополнительный файл/документ, если он есть (из 8 лабы) --}}
                        @if($exhibit->attachment)
                            <div class="mt-4">
                                <a href="{{ asset('storage/' . $exhibit->attachment) }}" target="_blank" class="btn btn-outline-primary">
                                     Скачать документ к экспонату
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>