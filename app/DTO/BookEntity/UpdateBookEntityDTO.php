<?php

namespace App\DTO\BookEntity;

use App\Http\Requests\BookEntity\StoreBookEntityRequest;
use App\Http\Requests\BookEntity\UpdateBookEntityRequest;

final class UpdateBookEntityDTO
{
    public function __construct(
        readonly public ?string $title,
        readonly public ?string $description,
    ) {}

    public static function fromRequest(UpdateBookEntityRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
        );
    }
}
