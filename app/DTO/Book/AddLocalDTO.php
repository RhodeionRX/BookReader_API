<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\StoreBookLocalizationRequest;

final class AddLocalDTO
{
    public function __construct(
        readonly public string $title,
        readonly public ?string $description,
        readonly public string $language,
        readonly public int $book_id
    ) {}
    public static function fromRequest(StoreBookLocalizationRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            language: $request->validated('language'),
            book_id: $request->validated('book_id'),
        );
    }
    public static function fromValues(string $title, string|null $description, string $language, int $book_id)
    {
        return new self(
            title: $title,
            description: $description,
            language: $language,
            book_id: $book_id
        );
    }
}
