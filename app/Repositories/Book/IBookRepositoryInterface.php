<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Filters\BookFilter;
use App\Models\BookImage;
use App\Models\BookDetails;
use App\Models\User;

interface IBookRepositoryInterface
{
    // Books
    public function create(User $user);

}
