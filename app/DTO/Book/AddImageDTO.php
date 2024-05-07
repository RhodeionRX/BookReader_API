<?php

namespace App\DTO\Book;

use App\Enums\LanguagesEnum;
use App\Http\Requests\Book\StoreBookDetailsRequest;

final class AddImageDTO
{
    public function __construct(
        readonly public string $content,
        readonly public int $detail_id
    ) {}

    public static function fromValues(string $content, int $detail_id)
    {
        return new self(
            content: $content,
            detail_id: $detail_id
        );
    }
}
