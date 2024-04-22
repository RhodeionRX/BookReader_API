<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookDetailsRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookDetailsResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookDetailsController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function add(StoreBookDetailsRequest $request): JsonResponse
    {
        return BookDetailsResource::make($this->service->addDetails(
            AddDetailsDTO::fromRequest($request))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        return BookDetailsResource::make(
            $this->service->update(
                $id,
                UpdateBookDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
