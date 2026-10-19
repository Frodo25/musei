<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateExhibitRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->boolean('is_published'),
        ]);
    }

    public function rules(): array
    {
        return [
            'hall_id'      => ['required', 'exists:halls,id'],
            'title'        => [
                'required', 
                'string', 
                'max:255', 
                Rule::unique('exhibits', 'title')->ignore($this->route('exhibit'))
            ],
            'author'       => ['required', 'string', 'max:120'],
            'year'         => ['required', 'integer', 'between:-5000,' . date('Y')],
            'description'  => ['nullable', 'string', 'max:2000'],
            'is_published' => ['boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'required'     => 'Поле «:attribute» обязательно для заполнения',
            'title.unique' => 'Экспонат с таким наименованием уже существует',
            'year.between' => 'Год создания должен быть от :min до :max',
            'exists'       => 'Выбранный зал не существует',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'        => 'название',
            'author'       => 'автор',
            'year'         => 'год',
            'hall_id'      => 'зал',
            'description'  => 'описание',
            'is_published' => 'публикация',
        ];
    }
}
