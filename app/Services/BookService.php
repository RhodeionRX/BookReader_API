<?php
namespace App\Services;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\DestroyBookDTO;
use App\DTO\Book\GetOneBookDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;
use App\Repositories\BaseRepository;
use App\Repositories\Book\BookRepositoryInterface;

class BookService
{
    public function __construct(
//        protected BookRepositoryInterface $repository
    ) {}
    public function init(CreateBookDTO $dto) : Book
    {
        $book = new Book();
        $book->save();

        return $book;
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
        $books = Book::with(['localizations'])->get();
        return $books;
    }

    public function getOne(int $id)
    {
        $book = Book::with('localizations')->where('id', $id)->firstOrFail();
        return $book;
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
