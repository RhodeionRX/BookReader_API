<?php

namespace App\Http\Controllers;

use App\DTO\Book\CreateBookDTO;
use App\DTO\Book\GetOneBookDTO;
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
        $dto = new CreateBookDTO(...$request->all());
        $book = $this->service->init($dto);

        return response()->json([
            'content' => $book,
            'message' => 'A new book have been successfully created'
        ], Response::HTTP_CREATED);
    }

    public function index(Request $request)
    {
        $books = $this->service->getAll();
        return response()->json(['content' => $books], Response::HTTP_OK);
    }

    public function show(Request $request)
    {
        $dto = new GetOneBookDTO($request->route('id'));
        $book = $this->service->getOne($dto);
        return response()->json(['content' => $book], Response::HTTP_OK);
    }
}
