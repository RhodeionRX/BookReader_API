<?php

namespace App\DTO\BookEntity;

use App\Http\Requests\BookEntity\UpdateBookPageRequest;

final class UpdateBookPageDTO
{
    public function __construct(
        readonly public string $content,
    ) {}

    public static function fromRequest(UpdateBookPageRequest $request)
    {
        return new self(
            content: $request->validated('content'),
        );
    }
}
