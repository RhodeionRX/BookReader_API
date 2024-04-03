<?php

namespace App\Http\Requests;

use App\Enums\LanguagesEnum;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class StoreBookLocalizationRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'min:3', 'max:100'],
            'description' => ['sometimes'],
            'language' => [
                'required',
                Rule::in(array_map(fn($case) => $case->value, LanguagesEnum::cases())),
            ],
            'book_id' => ['required']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'errors' => $validator->errors(),
        ], Response::HTTP_UNPROCESSABLE_ENTITY));
    }
}
