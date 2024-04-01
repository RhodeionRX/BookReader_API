<?php

namespace App\Http\Controllers;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\DestroyBookDTO;
use App\DTO\Book\GetOneBookDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Services\BookService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{
    protected $service;

    public function __construct(BookService $service)
    {
        $this->service = $service;
    }

    public function init(Request $request): JsonResponse
    {
        $dto = new CreateBookDTO(
            $request->input('title'),
            $request->input('description', null),
            $request->input('language')
        );
        $book = $this->service->init($dto);

        return response()->json([
            'content' => $book,
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
        $dto = new GetOneBookDTO($request->route('id'));
        $book = $this->service->getOne($dto);
        return response()->json([
            'content' => $book
        ], Response::HTTP_OK);
    }

    public function add(Request $request): JsonResponse
    {
        $dto = new AddLocalDTO(
            $request->input('title'),
            $request->input('description', null),
            $request->input('language'),
            $request->route('id')
        );
        $bookLocal = $this->service->createLocal($dto);
        return response()->json([
            'content' => $bookLocal,
            'message' => 'A new localization has been added successfully'], Response::HTTP_OK);
    }

    public function update(Request $request): JsonResponse
    {
        $dto = new UpdateBookDTO(
            $request->route('id'),
            $request->input('title', null),
            $request->input('description', null)
        );
        $bookLocal = $this->service->update($dto);
        return response()->json([
            'content' => $bookLocal,
            'message' => 'The localization has been added successfully'], Response::HTTP_OK);
    }

    public function destroy(Request $request): JsonResponse
    {
        $dto = new DestroyBookDTO(
            $request->route('id')
        );
        $bookLocal = $this->service->destroy($dto);
        return response()->json([
            'content' => $bookLocal,
            'message' => 'The localization has been archived successfully'], Response::HTTP_OK);
    }
}
