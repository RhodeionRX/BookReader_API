<?php

namespace App\Services\Book;

use App\Filters\BookFilter;
use App\Repositories\Book\IBookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;

class BookService
{
    public function __construct(
        protected IBookRepositoryInterface $repository,
    ) {}

    // Books
    public function getAll(BookFilter $filter)
    {
        return $this->repository->all(filter: $filter, relations: 'details.images', limit: 10);
    }

    public function show(int $id)
    {
        return $this->repository
            ->find(
                id: $id,
                relations: 'details.images',
                withTrashed: true
            );
    }
    public function create()
    {
        DB::beginTransaction();

        try {
            $book = $this->repository->create();
            $book->SetCreator();

            DB::commit();

            return $book;
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
