<?php

namespace App\DTO\Language;

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
