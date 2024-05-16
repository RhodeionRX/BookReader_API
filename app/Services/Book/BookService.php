<?php

namespace App\Services\Book;

use App\Filters\BookFilter;
use App\Repositories\Book\IBookRepositoryInterface;
use Illuminate\Http\Request;
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

    public function getOne(int $id)
    {
        return $this->repository
            ->find(
                id: $id,
                relations: 'details.images',
                withTrashed: true
            );
    }
    public function create(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;
        return $this->repository->create($user);
    }
    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
