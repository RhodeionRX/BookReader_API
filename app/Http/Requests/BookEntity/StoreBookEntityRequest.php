<?php

namespace App\Http\Requests\BookEntity;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookEntityRequest extends FormRequest
{
    use ErrorsToJson;

    public function rules() : array
    {
        return [
            'title' => ['required', 'string', 'min:3', 'max:100'],
            'description' => ['sometimes', 'string', 'min:3', 'max:255'],
            'book_id' => ['required', 'integer', 'exists:books,id'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
