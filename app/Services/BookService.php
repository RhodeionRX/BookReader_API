<?php
namespace App\Services;

use App\DTO\Book\CreateBookDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;

class BookService
{
    public function init(CreateBookDTO $dto) : Book
    {
        $book = new Book();
        $book->save();

        $local = new BookLocalInfo();
        $local->title = $dto->title;
        $local->description = $dto->description;
        $local->language = $dto->language;
        $local->book_id = $book->id;

        return $book;
    }

    public function getAll()
    {
        $books = Book::all();

        return $books;
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
