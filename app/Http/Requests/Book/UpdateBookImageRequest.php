<?php

namespace App\Http\Requests\Book;

use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookImageRequest extends FormRequest
{
    use ErrorsToJson;
    public function rules(): array
    {
        return [
            'image' => ['sometimes', 'image:jpg,jpeg,png'],
            'status' => [
                'sometimes',
                Rule::in(array_map(fn($case) => $case->value, ImageStatusEnum::cases())),
            ],
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
