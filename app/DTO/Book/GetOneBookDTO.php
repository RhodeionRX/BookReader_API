<?php

namespace App\DTO\Book;

final class GetOneBookDTO
{
    public readonly int $id;
    public function __construct(int $id) {
        $this->id = $id;
    }
}
