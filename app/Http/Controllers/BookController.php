<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\Book\BookCollection;
use App\Http\Resources\Book\BookLocalizationResource;
use App\Http\Resources\Book\BookResource;
use App\Services\BookService;

class BookController extends Controller
{
    public function __construct(protected BookService $service) {}

    public function create(StoreBookRequest $request): BookResource
    {
        $book = $this->service->create();

        $localization = $this->service->addLocalization(
            AddLocalDTO::fromValues(
                $request->validated('title'),
                $request->validated('description'),
                $request->validated('language'),
                $book->id
            )
        );

        return BookResource::make(
            $book
        );
    }

    public function index(): BookCollection
    {
        return BookCollection::make(
            $this->service->getAll()
        );
    }

    public function show(int $id): BookResource
    {
        return BookResource::make(
            $this->service->getOne($id)
        );
    }

    public function destroy(int $id): BookResource
    {
        return BookResource::make($this->service->destroy($id));
    }
}
