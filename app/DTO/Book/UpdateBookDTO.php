<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\UpdateBookRequest;
use Illuminate\Http\Request;

final class UpdateBookDTO
{
    public function __construct(
        public readonly ?string $title,
        public readonly ?string $description,
    ) {}

    public static function fromRequest(UpdateBookRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
        );
    }
    public static function fromValues(string $title, string|null $description)
    {
        return new self(
            title: $title,
            description: $description,
        );
    }
}
