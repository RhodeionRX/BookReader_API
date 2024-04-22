<?php

namespace App\DTO\Book;

use App\Enums\LanguagesEnum;
use App\Http\Requests\Book\StoreBookDetailsRequest;

final class AddImageDTO
{
    public function __construct(
        readonly public string $content,
//        readonly public string $status,
        readonly public LanguagesEnum $language,
        readonly public int $detail_id
    ) {}

    public static function fromValues(string $content, string $language, int $detail_id)
    {
        return new self(
            content: $content,
//            status: $status,
            language: LanguagesEnum::tryFrom($language),
            detail_id: $detail_id
        );
    }
}
