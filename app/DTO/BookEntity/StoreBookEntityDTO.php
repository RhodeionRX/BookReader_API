<?php

namespace App\DTO\BookEntity;

use App\Http\Requests\BookEntity\StoreBookEntityRequest;

final class StoreBookEntityDTO
{
    public function __construct(
        readonly public string $title,
        readonly public ?string $description,
        readonly public int $book_id
    ) {}

    public static function fromRequest(StoreBookEntityRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            book_id: $request->validated('book_id')
        );
    }
}
