<?php
namespace App\Services;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\GetOneBookDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;

class BookService
{
    public function init(CreateBookDTO $dto) : Book
    {
        $book = new Book();
        $book->save();

        $addDto = new AddLocalDTO($dto->title, $dto->description, $dto->language, $book->id);
        $this->createLocal($addDto);

        return $book;
    }

    public function createLocal(AddLocalDTO $dto) : BookLocalInfo
    {
        $localInfo = new BookLocalInfo();
        $localInfo->title = $dto->title;
        $localInfo->description = $dto->description;
        $localInfo->language = $dto->language;
        $localInfo->book_id = $dto->bookId;

        $localInfo->save();

        return $localInfo;
    }

    public function getAll()
    {
        $books = Book::with(['localizations'])->get();
        return $books;
    }

    public function getOne(GetOneBookDTO $dto)
    {
        $book = Book::with('localizations')->where('id', $dto->id)->firstOrFail();
        return $book;
    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
