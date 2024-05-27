<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookImageRequest;
use App\Http\Requests\Book\UpdateBookImageRequest;
use App\Http\Resources\Book\BookImageResource;
use App\Services\Book\BookImageService;
use App\Services\Book\BookService;
use App\Services\File\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookImageController extends Controller
{

    public function __construct(
        protected BookImageService $service,
    ) {}

    public function store(StoreBookImageRequest $request): JsonResponse
    {
        return BookImageResource::make(
            $this->service->create(
                AddImageDTO::fromValues(
                    FileService::saveFile($request->file('image'), 'previews'),
                    $request->validated('detail_id')
                )
            )
        )->response()->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(int $id): BookImageResource
    {
        return BookImageResource::make(
            $this->service->find($id)
        );
    }

    public function update(UpdateBookImageRequest $request, int $id): JsonResponse
    {
        $url = null;
        if ($request->hasFile('image')) {
            $url = FileService::saveFile($request->file('image'));
        }

        return BookImageResource::make(
            $this->service->update(
                $id,
                UpdateImageDTO::fromValues($url, $request->validated('status'))
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id): JsonResponse
    {
        return BookImageResource::make(
            $this->service->destroy($id)
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
