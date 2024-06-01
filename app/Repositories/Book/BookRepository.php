<?php

namespace App\Repositories\Book;

use App\Models\Book;
use App\Repositories\BaseRepository;

class BookRepository extends BaseRepository implements IBookRepositoryInterface
{
    public function __construct(Book $book) {
        parent::__construct($book);
    }

    // Books
    public function create()
    {
        return Book::create();
    }
}
