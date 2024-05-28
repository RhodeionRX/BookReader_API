<?php

namespace App\Services\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Repositories\BookImages\BookImageRepository;
use App\Repositories\BookImages\IBookImageRepositoryInterface;
use App\Services\File\FileService;
use Illuminate\Support\Facades\DB;

class BookImageService
{
    public function __construct(
        protected IBookImageRepositoryInterface $repository
    ) {}

    // Images

    public function find(int $id)
    {
        return $this->repository->find($id);
    }

    public function create(AddImageDTO $dto)
    {
        DB::beginTransaction();

        try {
            $image = $this->repository->create($dto);

            DB::commit();

            return $image;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
    }

    public function update(int $id, UpdateImageDTO $dto)
    {
        DB::beginTransaction();

        try {
            $image = $this->repository->update(
                $this->repository->find($id),
                $dto
            );

            DB::commit();

            return $image;
        } catch (\Throwable $exception) {
            DB::rollBack();

            throw $exception;
        }
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
