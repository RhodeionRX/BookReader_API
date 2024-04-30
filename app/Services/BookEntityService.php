<?php

namespace App\Services;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
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

    public function update(int $id, UpdateBookEntityDTO $dto)
    {
        $bookEntity = $this->repository->find($id);
        return $this->repository->update($bookEntity, $dto);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }
}
