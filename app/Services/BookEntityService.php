<?php

namespace App\Services;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\Repositories\BookEntity\IBookEntityRepositoryInterface;

class BookEntityService
{
    public function __construct(
        protected IBookEntityRepositoryInterface $repository
    ) {}

    public function create(StoreBookEntityDTO $dto)
    {
        return $this->repository->create($dto);
    }
}
