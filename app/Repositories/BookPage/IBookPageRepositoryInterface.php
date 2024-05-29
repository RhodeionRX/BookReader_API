<?php

namespace App\Repositories\BookPage;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Models\BookPage;

interface IBookPageRepositoryInterface
{
    public function find(int $entity_id, int $number);
    public function create(StoreBookPageDTO $dto);
    public function update(BookPage $page, UpdateBookPageDTO $dto);
    public function destroy(BookPage $page);
}
