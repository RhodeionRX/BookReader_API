<?php

namespace App\Http\Requests\Book;

use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBookImageRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'image' => ['sometimes', 'image:jpg,jpeg,png'],
            'status' => [
                'required',
                Rule::in(array_map(fn($case) => $case->value, ImageStatusEnum::cases())),
            ],
        ];
    }
}
