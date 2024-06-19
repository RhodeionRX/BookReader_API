<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddDetailsDTO;
use App\Filters\BookFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\GetAllBooksRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookResource;
use App\Models\Book;
use App\Models\BookDetails;
use App\Services\Book\BookDetailsService;
use App\Services\Book\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function create(
        StoreBookRequest $request,
        BookDetailsService $detailsService
    ): JsonResponse
    {
        $book = $this->service->create();

        $localization = $detailsService->create(
            AddDetailsDTO::fromValues(
                $request->validated('title'),
                $request->validated('description'),
                $request->validated('language'),
                $book->id
            )
        );

        return BookResource::make($book)
            ->response()
            ->setStatusCode(
                Response::HTTP_CREATED
            );
    }

    public function index(BookFilter $filter): BookCollection
    {
        return BookCollection::make(
            $this->service->index($filter)
        );
    }

    public function show(int $id): BookResource
    {
        return BookResource::make(
            $this->service->show($id)
        );
    }

    public function destroy(Book $book): JsonResponse
    {
        return BookResource::make(
            $this->service->destroy($book)
        )
            ->response()
            ->setStatusCode(
                Response::HTTP_ACCEPTED
            );
    }
}
