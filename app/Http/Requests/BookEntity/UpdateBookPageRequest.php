<?php

namespace App\Http\Requests\BookEntity;

use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBookPageRequest extends FormRequest
{
    use ErrorsToJson;
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
