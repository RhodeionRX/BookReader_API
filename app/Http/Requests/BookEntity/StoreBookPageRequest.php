<?php

namespace App\Http\Requests\BookEntity;

use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookPageRequest extends FormRequest
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
            'number' => ['required', 'integer'],
            'content' => ['required', 'string'],
            'entity_id' => ['required', 'integer', 'exists:book_entity,id']
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
