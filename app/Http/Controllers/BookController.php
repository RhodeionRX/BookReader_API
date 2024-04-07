<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Exceptions\ApiException;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookCollection;
use App\Http\Resources\BookLocalizationResource;
use App\Http\Resources\BookResource;
use App\Models\Book;
use App\Services\BookService;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpException;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $bookService)
    {
        $this->service = $bookService;
    }

    public function init(StoreBookRequest $request): BookResource
    {
        $book = $this->service->init();

        $localization = $this->service->createLocalization(
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

    public function add(StoreBookLocalizationRequest $request): BookResource
    {
        return BookResource::make($this->service->createLocalization(
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

    public function destroy(int $id): BookResource
    {
        return BookResource::make($this->service->destroy($id));
    }
}
