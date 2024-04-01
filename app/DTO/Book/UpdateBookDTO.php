<?php

namespace App\DTO\Book;

final class UpdateBookDTO
{
    public readonly int $id;
    public readonly ?string $title;
    public readonly ?string $description;

    public function __construct(int $id, ?string $title, ?string $description)
    {
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
    }
}
