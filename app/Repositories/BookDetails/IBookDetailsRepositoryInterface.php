<?php

namespace App\Repositories\BookDetails;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\BookDetails;

interface IBookDetailsRepositoryInterface
{
    // Details aka localizations
    public function create(AddDetailsDTO $dto);
    public function update(BookDetails $bookDetails, UpdateBookDTO $dto);

}
