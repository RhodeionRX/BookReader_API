<?php

namespace App\Http\Requests\Book;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use App\Traits\ErrorsToJson;

class StoreBookPageRequest extends FormRequest
{
    use ErrorsToJson;

    public function rules() : array
    {
        return [
            'number' => ['required', 'integer'],
            'content' => ['sometimes', 'string'],
            'entity_id' => ['required', 'integer']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
