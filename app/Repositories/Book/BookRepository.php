<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;
use App\Repositories\BaseRepository;
use stdClass;
class BookRepository implements BookRepositoryInterface
{
    public function __construct()
    {
    }
    public function create()
    {
        return Book::create();
    }


    public function add(AddLocalDTO $dto)
    {
        return BookLocalInfo::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'language' => $dto->language,
            'book_id' => $dto->book_id
        ]);
    }
    public function find(int $id)
    {
        return Book::with('localizations')->findOrFail($id);
    }

    public function findAll()
    {
        return Book::with('localizations')->get();
    }

    public function findLocalization(int $id)
    {
        return BookLocalInfo::findOrFail($id);
    }

    public function update(BookLocalInfo $localization, UpdateBookDTO $dto)
    {
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
