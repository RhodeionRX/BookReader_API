<?php

namespace App\Http\Requests\BookEntity;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookEntityRequest extends FormRequest
{
    use ErrorsToJson;

    public function rules() : array
    {
        return [
            'title' => ['sometimes', 'string', 'min:3', 'max:100'],
            'description' => ['sometimes', 'string', 'min:3', 'max:255'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
