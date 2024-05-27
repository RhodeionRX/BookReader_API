<?php

namespace App\Services\Book;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\Repositories\BookPage\IBookPageRepositoryInterface;

class BookPageService
{
    public function __construct(
        protected IBookPageRepositoryInterface $repository
    ) {}
    public function create(StoreBookPageDTO $dto)
    {
        return $this->repository->create($dto);
    }
}
