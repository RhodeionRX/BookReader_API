<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookLocalizationResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookLocalizationController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function add(StoreBookLocalizationRequest $request): JsonResponse
    {
        return BookLocalizationResource::make($this->service->addLocalization(
            AddLocalDTO::fromRequest($request))
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }
    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        return BookLocalizationResource::make(
            $this->service->update(
                $id,
                UpdateBookDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
