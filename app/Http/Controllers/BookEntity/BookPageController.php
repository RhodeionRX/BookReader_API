<?php

namespace App\Http\Controllers\BookEntity;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookEntity\StoreBookEntityRequest;
use App\Http\Requests\BookEntity\StoreBookPageRequest;
use App\Http\Requests\BookEntity\UpdateBookPageRequest;
use App\Http\Resources\Book\BookPageResource;
use App\Http\Resources\Book\BookResource;
use App\Services\Book\BookPageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookPageController extends Controller
{
    public function __construct(
        protected BookPageService $service
    ) {}

    public function store(StoreBookPageRequest $request) : JsonResponse
    {
        return BookPageResource::make(
            $this->service->create(
                StoreBookPageDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(
        UpdateBookPageRequest $request,
        int $id
    ) : JsonResponse
    {
        return BookPageResource::make(
            $this->service->update(
                $id,
                UpdateBookPageDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(int $id) : JsonResponse
    {
        return BookPageResource::make(
            $this->service->destroy($id)
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
