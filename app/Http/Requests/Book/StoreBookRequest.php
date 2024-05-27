<?php

namespace App\Http\Requests\Book;

use App\Enums\LanguagesEnum;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreBookRequest extends FormRequest
{
    use ErrorsToJson;
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:100'],
            'description' => ['sometimes'],
            'language' => [
                'required',
                Rule::in(array_map(fn($case) => $case->value, LanguagesEnum::cases())),
                ]
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
