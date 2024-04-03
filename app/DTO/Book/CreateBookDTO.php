<?php

namespace App\DTO\Book;

use App\Http\Requests\StoreBookRequest;
use GuzzleHttp\Psr7\Request;

final class CreateBookDTO
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $description,
        public readonly string $language,
    ) {}

    public static function fromRequest(StoreBookRequest $request)
    {
        return new self(
          title: $request->validated('title'),
          description: $request->validated('description'),
          language: $request->validated('language'),
        );
    }

    public static function fromValues(string $title, string|null $description, string $language, int $book_id)
    {
        return new self(
            title: $title,
            description: $description,
            language: $language,
        );
    }
}
