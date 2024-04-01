<?php

namespace App\DTO\Language;

final class GetLanguageDTO
{
    public readonly int $id;
    public function __construct(int $id) {
        $this->id = $id;
    }

    public function validate()
    {

    }
}
