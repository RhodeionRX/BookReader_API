<?php

namespace App\Services\Book;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Repositories\BookDetails\BookDetailsRepository;
use Illuminate\Support\Facades\DB;

class BookDetailsService
{
    public function __construct(
        protected BookDetailsRepository $repository) {}

    public function create(AddDetailsDTO $dto)
    {
        DB::beginTransaction();

        try {
            $detail = $this->repository->create($dto);
            $detail->book->setUpdater();

            DB::commit();

            return $detail;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function update(int $id, UpdateBookDTO $dto)
    {
        DB::beginTransaction();

        try {
            $detail = $this->repository->update(
                $this->repository->find(
                    id: $id,
                    withTrashed: true
                ), $dto
            );
            $detail->book->setUpdater();

            DB::commit();

            return $detail;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }
}
