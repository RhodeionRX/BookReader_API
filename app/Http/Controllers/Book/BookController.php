<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddLocalDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function create(StoreBookRequest $request): JsonResponse
    {
        $book = $this->service->create();

        $localization = $this->service->addLocalization(
            AddLocalDTO::fromValues(
                $request->validated('title'),
                $request->validated('description'),
                $request->validated('language'),
                $book->id
            )
        );

        return BookResource::make(
            $book
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function index(): BookCollection
    {
        return BookCollection::make(
            $this->service->getAll()
        );
    }

    public function show(int $id): BookResource
    {
        return BookResource::make(
            $this->service->getOne($id)
        );
    }

    public function destroy(int $id): JsonResponse
    {
        return BookResource::make(
            $this->service->destroy($id)
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
