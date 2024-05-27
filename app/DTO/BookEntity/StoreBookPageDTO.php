<?php

namespace App\DTO\BookEntity;

use App\Http\Requests\BookEntity\StoreBookPageRequest;

final class StoreBookPageDTO
{
    public function __construct(
        readonly public int $number,
        readonly public string $content,
        readonly public int $entity_id
    ) {}

    public static function fromRequest(StoreBookPageRequest $request)
    {
        return new self(
            number: $request->validated('number'),
            content: $request->validated('content'),
            entity_id: $request->validated('entity_id')
        );
    }
}
