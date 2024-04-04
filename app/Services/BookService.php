<?php
namespace App\Services;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;

class BookService
{
    public function __construct(
//        protected BookRepositoryInterface $repository
    ) {}
    public function init() : Book
    {
        return Book::create();
    }

    public function createLocal(AddLocalDTO $dto) : BookLocalInfo
    {
        $localization = new BookLocalInfo();
        $localization->title = $dto->title;
        $localization->description = $dto->description;
        $localization->language = $dto->language;
        $localization->book_id = $dto->book_id;
        $localization->save();

        return $localization;
    }

    public function getAll()
    {
        return Book::with(['localizations'])->get();
    }

    public function getOne(int $id)
    {
        return Book::with('localizations')->where('id', $id)->firstOrFail();
    }

    public function update(int $id, UpdateBookDTO $dto)
    {
        $localization = BookLocalInfo::findOrFail($id);
        $localization->title = $dto->title;
        $localization->description = $dto->description;

        $localization->save();

        return $localization;
    }

    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return $book;
    }
}
