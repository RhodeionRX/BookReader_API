<?php

namespace App\Repositories\BookDetails;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\Book;
use App\Models\BookDetails;
use App\Models\User;
use App\Repositories\BaseRepository;

class BookDetailsRepository extends BaseRepository implements IBookDetailsRepositoryInterface
{
    public function __construct(BookDetails $bookDetails) {
        parent::__construct($bookDetails);
    }
    public function create(AddDetailsDTO $dto)
    {
        return BookDetails::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'language' => $dto->language,
            'book_id' => $dto->book_id
        ]);
    }

    public function update(BookDetails $bookDetails, UpdateBookDTO $dto)
    {
        $bookDetails->title = $dto->title;
        $bookDetails->description = $dto->description;
        $bookDetails->save();

        return $bookDetails;
    }
}
