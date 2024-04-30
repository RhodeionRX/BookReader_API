<?php

namespace App\Http\Controllers\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\BookEntity\StoreBookEntityRequest;
use App\Http\Resources\Book\BookEntityResource;
use App\Services\BookEntityService;
use Illuminate\Http\Response;

class BookEntityController extends Controller
{
    public function __construct(
        protected BookEntityService $service
    ){}
    public function store(StoreBookEntityRequest $request)
    {
        return BookEntityResource::make(
            $this->service->create(
                StoreBookEntityDTO::fromRequest($request)
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show()
    {

    }

    public function update()
    {

    }

    public function destroy()
    {

    }
}
