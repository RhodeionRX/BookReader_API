<?php

namespace App\Services\Book;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
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

    public function update(int $id, UpdateBookPageDTO $dto)
    {
        return $this->repository->update(
            $this->repository->find($id),
            $dto
        );
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
