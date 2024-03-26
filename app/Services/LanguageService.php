<?php

namespace App\Services;

use App\DTO\Language\AddLanguageDTO;
use App\DTO\Language\DeleteLanguageDTO;
use App\DTO\Language\GetLanguageDTO;
use App\DTO\Language\GetLanguagesDTO;
use App\Models\Language;
use Illuminate\Database\Eloquent\Collection;

class LanguageService
{
    public function addLanguage(AddLanguageDTO $addLanguageDTO) : Language
    {
        $language = new Language();
        $language->code = $addLanguageDTO->code;
        $language->save();

        return $language;
    }

    public function getLanguage(GetLanguageDTO $dto) : Language
    {
        $language = Language::where('id', $dto->id)->firstOrFail();

        return $language;
    }

    public function getAllLanguages(GetLanguagesDTO $dto) : array| Collection
    {
        $query = Language::query();

        if (!empty($dto->ids)) {
            $query->whereIn('id', $dto->ids);
        }

        if (!empty($dto->ids)) {
            $query->whereIn('code', $dto->codes);
        }

        $query->orderBy('id');

        $languages = $query->get();

        return $languages;
    }

    public function removeLanguage(DeleteLanguageDTO $dto) : Language
    {
        $language = Language::where('id', $dto->id)->firstOrFail();
        $language->delete();

        return $language;
    }

}
