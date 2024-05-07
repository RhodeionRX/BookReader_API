<?php

namespace App\DTO\BookEntity;

final class StoreBookPageDTO
{
    public function __construct(
        readonly public int $number,
        readonly public ?string $content,
        readonly public int $entity_id
    ) {}

    public static function fromRequest()
    {

    }
}
