<?php

namespace App\DTO\Book;

final class AddLocalDTO
{
    public readonly string $title;
    public readonly string $description;
    public readonly string $language;
    public readonly int $bookId;

    public function __construct(string $title, string $description, string $language, int $bookId)
    {
        $this->title = $title;
        $this->description = $description;
        $this->language = $language;
        $this->bookId = $bookId;
    }
}
