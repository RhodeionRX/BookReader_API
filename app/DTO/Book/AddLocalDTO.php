<?php

namespace App\DTO\Book;

use App\Http\Requests\StoreBookRequest;

final class AddLocalDTO
{
//    public readonly string $title;
//    public readonly ?string $description;
//    public readonly string $language;
//    public readonly int $bookId;
//$this->title = $title;
//$this->description = $description;
//$this->language = $language;
//$this->bookId = $bookId;
    public function __construct(
        readonly public string $title,
        readonly public ?string $description,
        readonly public string $language,
        readonly public int $bookId
    ) {}
    public static function fromRequest(StoreBookRequest $request)
    {
        return new self(
            title: $request->validated('title'),
            description: $request->validated('description'),
            language: $request->validated('language'),
            bookId: $request->validated('bookId'),
        );
    }
    public static function init(string $title, string|null $description, string $language, int $bookId)
    {
        return new self(
            title: $title,
            description: $description,
            language: $language,
            bookId: $bookId
        );
    }

}
