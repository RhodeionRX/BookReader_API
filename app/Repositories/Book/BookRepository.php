<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\User;
use App\Repositories\BaseRepository;

class BookRepository extends BaseRepository implements IBookRepositoryInterface
{
    public function __construct(Book $book) {
        parent::__construct($book);
    }

    // Books
    public function create(User $user)
    {
        return Book::create([
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
    }
}
