<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookLocalizationResource;
use App\Http\Resources\Book\BookResource;
use App\Services\BookService;
use Illuminate\Http\Request;

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
