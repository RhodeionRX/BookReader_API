<?php

namespace App\Http\Controllers\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookEntity\StoreBookEntityRequest;
use App\Http\Requests\BookEntity\UpdateBookEntityRequest;
use App\Http\Resources\Book\BookEntityResource;
use App\Services\BookEntityService;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class BookEntityController extends Controller
{
    public function __construct(
        protected BookEntityService $service
    ){}
    public function store(StoreBookEntityRequest $request) : JsonResponse
    {
        return BookEntityResource::make(
            $this->service->create(
                StoreBookEntityDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function update(UpdateBookEntityRequest $request, int $id) : JsonResponse
    {
        return BookEntityResource::make(
            $this->service->update(
                $id,
                UpdateBookEntityDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_OK);
    }

    public function destroy(int $id) : JsonResponse
    {
        return BookEntityResource::make(
            $this->service->destroy($id)
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
