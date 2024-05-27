<?php

namespace App\Repositories\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Models\BookEntity;

interface IBookEntityRepositoryInterface
{
    public function create(StoreBookEntityDTO $dto);
    public function update(BookEntity $bookEntity, UpdateBookEntityDTO $dto);
}
