<?php

namespace App\Services\Book;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Repositories\BookEntity\IBookEntityRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();

        try {
            $entity = $this->repository->create($dto);

            DB::commit();

            return $entity;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function update(int $id, UpdateBookEntityDTO $dto)
    {
        DB::beginTransaction();

        try {
            $entity = $this->repository->update(
                $this->repository->find(id: $id, withTrashed: true),
                $dto
            );

            DB::commit();

            return $entity;
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
