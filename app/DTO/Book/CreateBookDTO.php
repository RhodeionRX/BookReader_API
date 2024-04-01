<?php

namespace App\DTO\Book;

final class CreateBookDTO
{
    public readonly string $title;
    public readonly ?string $description;
    public readonly string $language;

    public function __construct(string $title, ?string $description, string $language)
    {
        $this->title = $title;
        $this->description = $description;
        $this->language = $language;
    }
}
