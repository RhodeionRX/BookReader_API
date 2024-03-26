<?php

namespace App\DTO\Language;

final class GetLanguagesDTO
{
    public readonly ?array $ids;
    public readonly ?array $codes;
    public function __construct(array $ids = [], array $codes = []) {
        $this->ids = $ids;
        $this->codes = $codes;
    }

    public function validate()
    {

    }

}
