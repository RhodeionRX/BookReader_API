<?php

namespace App\DTO\Language;

use Illuminate\Http\Request;
use Ramsey\Uuid\Rfc4122\Validator;

final class AddLanguageDTO
{
    public readonly string $code;
    public function __construct(string $code) {
        $this->code = $code;
    }

    public function validate()
    {

    }

}
