<?php

namespace App\Http\Requests\Book;

use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBookImageRequest extends FormRequest
{
    use ErrorsToJson;

    public function rules(): array
    {
        return [
            'image' => ['required', 'image:jpg,jpeg,png'],
            'detail_id' => ['required', 'exists:book_details,id']
        ];
    }
    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
