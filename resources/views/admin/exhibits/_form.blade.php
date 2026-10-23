<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @isset($exhibit)
        @method('PUT')
    @endisset

    <!-- Название -->
    <div class="mb-3">
        <label for="title" class="form-label">Название экспоната:</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $exhibit->title ?? '') }}">
        @error('title') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Автор -->
    <div class="mb-3">
        <label for="author" class="form-label">Автор / Мастер:</label>
        <input type="text" name="author" id="author" class="form-control" value="{{ old('author', $exhibit->author ?? '') }}">
        @error('author') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Зал -->
    <div class="mb-3">
        <label for="hall_id" class="form-label">Зал:</label>
        <select name="hall_id" id="hall_id" class="form-control">
            <option value="">-- Выберите зал --</option>
            @foreach($halls as $hall)
                <option value="{{ $hall->id }}" {{ (old('hall_id', $exhibit->hall_id ?? '') == $hall->id) ? 'selected' : '' }}>
                    {{ $hall->name }}
                </option>
            @endforeach
        </select>
        @error('hall_id') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Год -->
    <div class="mb-3">
        <label for="year" class="form-label">Год создания:</label>
        <input type="number" name="year" id="year" class="form-control" value="{{ old('year', $exhibit->year ?? '') }}">
        @error('year') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Описание -->
    <div class="mb-3">
        <label for="description" class="form-label">Описание:</label>
        <textarea name="description" id="description" class="form-control">{{ old('description', $exhibit->description ?? '') }}</textarea>
        @error('description') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Обложка (Картинка) -->
    <div class="mb-3">
        <label for="cover" class="form-label">Обложка (изображение):</label><br>
        <input type="file" name="cover" id="cover" accept="image/*" class="form-control">
        @error('cover') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Дополнительный файл / документ -->
    <div class="mb-3">
        <label for="attachment" class="form-label">Документ / Файл:</label><br>
        <input type="file" name="attachment" id="attachment" class="form-control">
        @error('attachment') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <!-- Публикация -->
    <div class="mb-3 form-check">
        <input type="checkbox" name="is_published" value="1" id="is_published" class="form-check-input" {{ old('is_published', $exhibit->is_published ?? true) ? 'checked' : '' }}>
        <label for="is_published" class="form-check-label">Опубликовано на сайте</label>
    </div>

    <button type="submit" class="btn btn-success">Сохранить</button>
</form>