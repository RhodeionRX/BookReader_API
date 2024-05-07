<?php

namespace App\Http\Controllers\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Book\StoreBookImageRequest;
use App\Http\Requests\Book\UpdateBookImageRequest;
use App\Http\Resources\Book\BookImageResource;
use App\Services\BookService;
use App\Services\FileService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class BookImageController extends Controller
{

    public function __construct(
        protected BookService $service,
    ) {}

    public function store(StoreBookImageRequest $request): JsonResponse
    {
        return BookImageResource::make(
            $this->service->addImage(
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
            $this->service->findImage($id)
        );
    }

    public function update(UpdateBookImageRequest $request, int $id): JsonResponse
    {
        $url = null;
        if ($request->hasFile('image')) {
            $url = FileService::saveFile($request->file('image'));
        }

        return BookImageResource::make(
            $this->service->updateImage(
                $id,
                UpdateImageDTO::fromValues($url, $request->validated('status'))
            )
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(string $id): JsonResponse
    {
        return BookImageResource::make(
            $this->service->deleteImage($id)
        )->response()->setStatusCode(Response::HTTP_ACCEPTED);
    }
}
