<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookLocalizationResource;
use App\Services\BookService;

class BookLocalizationController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function add(StoreBookLocalizationRequest $request): BookLocalizationResource
    {
        return BookLocalizationResource::make($this->service->addLocalization(
            AddLocalDTO::fromRequest($request))
        );
    }
    public function update(UpdateBookRequest $request, int $id): BookLocalizationResource
    {
        return BookLocalizationResource::make(
            $this->service->update(
                $id,
                UpdateBookDTO::fromRequest($request)
            )
        );
    }
}
