<?php

namespace App\DTO\Book;

use App\Http\Requests\Book\StoreBookLocalizationRequest;

final class UpdateImageDTO
{
    public function __construct(
        readonly public ?string $content,
        readonly public ?string $status,
    ) {}

    public static function fromValues(?string $content, ?string $status): UpdateImageDTO
    {
        return new self(
            content: $content,
            status: $status
        );
    }
}
