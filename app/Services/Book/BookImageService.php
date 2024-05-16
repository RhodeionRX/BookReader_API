<?php

namespace App\Services\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Repositories\BookImages\BookImageRepository;
use App\Services\File\FileService;

class BookImageService
{
    public function __construct(
        protected BookImageRepository $repository
    ) {}

    // Images
    public function create(AddImageDTO $dto)
    {
        return $this->repository->create($dto);
    }

    public function update(int $id, UpdateImageDTO $dto)
    {
        return $this->repository->update(
            $this->repository->find($id),
            $dto
        );
    }

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function destroy(int $id)
    {
        $image = $this->repository->destroy($id);
        // Delete the image file
        $url = str_replace('storage', '', strval($image->content));
        FileService::deleteFile($url);

        return $image;
    }
}
