@if (session('success'))
    <div class="alert alert-success" style="color: green; padding: 10px; border: 1px solid green; margin-bottom: 15px;">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger" style="color: red; padding: 10px; border: 1px solid red; margin-bottom: 15px;">
        <strong>Исправьте ошибки в форме ({{ $errors->count() }}):</strong>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif