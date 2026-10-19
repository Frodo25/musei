<form method="POST" action="{{ $action }}">
    @csrf
    @isset($exhibit)
        @method('PUT')
    @endisset

    <div style="margin-bottom: 12px;">
        <label>Название экспоната:</label><br>
        <input type="text" name="title" value="{{ old('title', $exhibit->title ?? '') }}" 
               style="{{ $errors->has('title') ? 'border: 2px solid red;' : '' }}">
        @error('title') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 12px;">
        <label>Автор / Мастер:</label><br>
        <input type="text" name="author" value="{{ old('author', $exhibit->author ?? '') }}"
               style="{{ $errors->has('author') ? 'border: 2px solid red;' : '' }}">
        @error('author') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 12px;">
        <label>Зал:</label><br>
        <select name="hall_id" style="{{ $errors->has('hall_id') ? 'border: 2px solid red;' : '' }}">
            <option value="">-- Выберите зал --</option>
            @foreach ($halls as $hall)
                <option value="{{ $hall->id }}" @selected(old('hall_id', $exhibit->hall_id ?? '') == $hall->id)>
                    {{ $hall->name }}
                </option>
            @endforeach
        </select>
        @error('hall_id') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 12px;">
        <label>Год создания:</label><br>
        <input type="number" name="year" value="{{ old('year', $exhibit->year ?? '') }}"
               style="{{ $errors->has('year') ? 'border: 2px solid red;' : '' }}">
        @error('year') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 12px;">
        <label>Описание:</label><br>
        <textarea name="description" rows="4">{{ old('description', $exhibit->description ?? '') }}</textarea>
        @error('description') <div style="color: red; font-size: 0.9em;">{{ $message }}</div> @enderror
    </div>

    <div style="margin-bottom: 12px;">
        <label>
            <input type="checkbox" name="is_published" value="1"
                @checked(old('is_published', $exhibit->is_published ?? true))> Опубликовано на сайте
        </label>
    </div>

    <button type="submit">Сохранить</button>
</form>