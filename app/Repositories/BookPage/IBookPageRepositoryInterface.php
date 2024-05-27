<?php

namespace App\Repositories\BookPage;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Http\Requests\BookEntity\UpdateBookPageRequest;
use App\Models\BookPage;

interface IBookPageRepositoryInterface
{
    public function create(StoreBookPageDTO $dto);
    public function update(BookPage $page, UpdateBookPageDTO $dto);
}
