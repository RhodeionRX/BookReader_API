<?php

namespace App\Http\Requests\Book;

use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => ['required', 'image:jpg,jpeg,png'],
            'status' => [
                'sometimes',
                Rule::in(array_map(fn($case) => $case->value, ImageStatusEnum::cases())),
            ],
            'language' => [
                'sometimes',
                Rule::in(array_map(fn($case) => $case->value, LanguagesEnum::cases())),
            ],
            'book_id' => ['sometimes', 'exists:books,id']
        ];
    }
}
