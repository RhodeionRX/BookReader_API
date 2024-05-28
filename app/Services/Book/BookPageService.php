<?php

namespace App\Services\Book;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Repositories\BookPage\IBookPageRepositoryInterface;
use Illuminate\Support\Facades\DB;

class BookPageService
{
    public function __construct(
        protected IBookPageRepositoryInterface $repository
    ) {}
    public function create(StoreBookPageDTO $dto)
    {
        DB::beginTransaction();

        try {
            $page = $this->repository->create($dto);

            DB::commit();

            return $page;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function update(int $id, UpdateBookPageDTO $dto)
    {
        DB::beginTransaction();

        try {
            $page = $this->repository->update(
                $this->repository->find($id),
                $dto
            );

            DB::commit();

            return $page;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
