<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Requests\Book\StoreBookLocalizationRequest;
use App\Http\Requests\Book\StoreBookRequest;
use App\Http\Requests\Book\UpdateBookRequest;
use App\Http\Resources\BookResource;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

        $localization = $this->service->createLocal(
            AddLocalDTO::fromValues(
                $request->validated('title'),
                $request->validated('description'),
                $request->validated('language'),
                $book->id
            )
        );

        return BookResource::make([
                'book' => $book,
                'localization' => $localization,
                'message' => 'A new book has been successfully stored'
            ]
        );
    }

    public function index(): BookResource
    {
        return BookResource::make(
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
        return BookResource::make([
                'localization' => $this->service->createLocal(
                    AddLocalDTO::fromRequest($request)
                ),
                'message' => 'A new localization has been successfully stored'
            ]
        );
    }

    public function update(UpdateBookRequest $request, int $id): BookResource
    {
        return BookResource::make([
                'localization' => $this->service->update(
                    $id,
                    UpdateBookDTO::fromRequest($request)
                ),
                'message' => 'The localization has been successfully updated'
            ]

        );
    }

    public function destroy(int $id): BookResource
    {
        return BookResource::make([
                'book' => $this->service->destroy($id),
                'message' => 'The localization has been successfully archived'
            ]
        );
    }
}
