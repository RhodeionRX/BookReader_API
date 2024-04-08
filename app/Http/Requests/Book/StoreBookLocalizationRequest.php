<?php

namespace App\Http\Requests\Book;

use App\Enums\LanguagesEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
use App\Traits\ErrorsToJson;

class StoreBookLocalizationRequest extends FormRequest
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
            ],
            'book_id' => ['required', 'exists:books,id']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
