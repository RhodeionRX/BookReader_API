<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\DestroyBookDTO;
use App\DTO\Book\GetOneBookDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Http\Requests\StoreBookLocalizationRequest;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Models\Book;
use App\Models\BookLocalInfo;
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

    public function init(StoreBookRequest $request): JsonResponse
    {
        $dto = CreateBookDTO::fromRequest($request);
        $book = $this->service->init($dto);

        $localDto =  AddLocalDTO::fromValues($dto->title, $dto->description, $dto->language, $book->id);
        $localization = $this->service->createLocal($localDto);

        return response()->json([
            'content' => $book,
            'localization' => $localization,
            'message' => 'A new book has been successfully created'
        ], Response::HTTP_CREATED);
    }

    public function index(Request $request): JsonResponse
    {
        $books = $this->service->getAll();
        return response()->json([
            'content' => $books
        ], Response::HTTP_OK);
    }

    public function show(Request $request): JsonResponse
    {
        return response()->json([
            'content' => $this->service->getOne(
                $request->route('id')
            )
        ], Response::HTTP_OK);
    }

    public function add(StoreBookLocalizationRequest $request): JsonResponse
    {
        $dto = AddLocalDTO::fromRequest($request);
        $localization = $this->service->createLocal($dto);
        return response()->json([
            'content' => $localization,
            'message' => 'A new localization has been added successfully'], Response::HTTP_OK);
    }

    public function update(UpdateBookRequest $request, int $id): JsonResponse
    {
        $dto = UpdateBookDTO::fromRequest($request);

        $localization = $this->service->update($id, $dto);
        return response()->json([
            'content' => $localization,
            'message' => 'The book information has been added successfully'], Response::HTTP_OK);
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        $book = $this->service->destroy($id);
        return response()->json([
            'content' => $book,
            'message' => 'The book has been archived successfully'], Response::HTTP_NO_CONTENT);
    }
}
