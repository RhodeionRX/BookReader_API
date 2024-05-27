<?php

namespace App\Repositories\BookDetails;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Filters\BookFilter;
use App\Models\BookImage;
use App\Models\BookDetails;
use App\Models\User;

interface IBookDetailsRepositoryInterface
{
    // Details aka localizations
    public function create(AddDetailsDTO $dto);
    public function update(BookDetails $bookDetails, UpdateBookDTO $dto);

}
