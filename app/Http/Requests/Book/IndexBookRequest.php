<?php

namespace App\Http\Requests\Book;

use App\Enums\LanguagesEnum;
use App\Traits\ErrorsToJson;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IndexBookRequest extends FormRequest
{
    use ErrorsToJson;

    public function rules(): array
    {
        return [
          'title' => ['sometimes', 'string'],
          'language' => [
              'sometimes',
              Rule::in(
                  array_map(
                      fn($case) => $case->value,
                      LanguagesEnum::cases()
                  )
              )
          ],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        self::Respond($validator);
    }
}
