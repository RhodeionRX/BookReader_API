<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookDetailsRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookDetailsResource;
use App\Models\Book;
use App\Models\BookDetails;
use App\Services\Book\BookDetailsService;
use App\Services\Book\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookDetailsController extends Controller
{
    public function __construct(protected BookDetailsService $service) {}

    public function create(
        Book $book,
        StoreBookDetailsRequest $request
    ): JsonResponse
    {
        return BookDetailsResource::make(
            $this->service->create(
                AddDetailsDTO::fromRequest(
                    $book->id,
                    $request
                )
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
    public function update(
        BookDetails $detail,
        UpdateBookRequest $request
    ): JsonResponse
    {
        return BookDetailsResource::make(
            $this->service->update(
                $detail,
                UpdateBookDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
