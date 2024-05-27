<?php

namespace App\Http\Controllers\BookEntity;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookEntity\StoreBookEntityRequest;
use App\Http\Requests\BookEntity\StoreBookPageRequest;
use App\Http\Resources\Book\BookResource;
use App\Services\Book\BookPageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookPageController extends Controller
{
    public function __construct(
        protected BookPageService $service
    ) {}
    public function show() : JsonResponse
    {

    }

    public function store(StoreBookPageRequest $request) : JsonResponse
    {
        return BookResource::make(
            $this->service->create(
                StoreBookPageDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update() : JsonResponse
    {

    }

    public function destroy() : JsonResponse
    {

    }
}
