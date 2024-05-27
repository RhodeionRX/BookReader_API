<?php

namespace App\Services\Book;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Repositories\BookDetails\BookDetailsRepository;

class BookDetailsService
{
    public function __construct(
        protected BookDetailsRepository $repository) {}

    public function create(AddDetailsDTO $dto)
    {
        $detail = $this->repository->create($dto);
        $detail->book->setUpdater();
        return $detail;
    }

    public function update(int $id, UpdateBookDTO $dto)
    {
        $detail = $this->repository->update(
            $this->repository->find(
                id: $id,
                withTrashed: true
            ), $dto
        );
        $detail->book->setUpdater();

        return $detail;
    }
}
