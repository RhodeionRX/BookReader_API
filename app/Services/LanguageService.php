<?php

namespace App\Services;

use App\DTO\Language\AddLanguageDTO;
use App\Models\Language;

class LanguageService
{
    public function addLanguage(AddLanguageDTO $addLanguageDTO) : Language
    {
        $language = new Language();

        $language->code = $addLanguageDTO->code;

        $language->save();

        return $language;
    }
}
