<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\StoreBookLocalizationRequest;

final class AddImageDTO
{
    public function __construct(
        readonly public string $content,
        readonly public string $status,
        readonly public string $language,
        readonly public int $book_id
    ) {}
    public static function fromValues(string $content, string $status, string $language, int $book_id)
    {
        return new self(
            content: $content,
            status: $status,
            language: $language,
            book_id: $book_id
        );
    }
}
