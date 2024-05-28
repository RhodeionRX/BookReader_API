<?php

namespace App\Services\Book;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Repositories\BookEntity\IBookEntityRepositoryInterface;

class BookEntityService
{
    public function __construct(
        protected IBookEntityRepositoryInterface $repository
    ) {}

    public function show(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(StoreBookEntityDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, UpdateBookEntityDTO $dto)
    {
        $bookEntity = $this->repository->find(id: $id, withTrashed: true);
        return $this->repository->update($bookEntity, $dto);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
