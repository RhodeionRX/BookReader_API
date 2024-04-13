<?php
namespace App\Services;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Enums\ImageStatusEnum;
use App\Exceptions\ApiException;
use App\Repositories\Book\BookRepositoryInterface;

class BookService
{
    public function __construct(
        protected BookRepositoryInterface $repository
    ) {}

    // Books
    public function getAll()
    {
        return $this->repository->findAll();
    }

    public function getOne(int $id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            throw ApiException::Error($e->getMessage(), $e->getCode());
        }
    }
    public function create()
    {
        return $this->repository->create();
    }
    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }

    // Localizations
    public function addLocalization(AddLocalDTO $dto)
    {
        return $this->repository->addLocalization($dto);
    }

    public function update(int $id, UpdateBookDTO $dto)
    {
        $localization = $this->repository->findLocalization($id);
        return $this->repository->update($localization, $dto);
    }

    // Images
    public function addImage(AddImageDTO $dto)
    {
        // check if there is an image for the book
        $candidates = $this->repository->findImagesByBook($dto->book_id);

        if ($candidates->isEmpty())
        {
            return $this->repository->addImage(
                $dto,
                ImageStatusEnum::Primary->value
            );
        }

        return $this->repository->addImage($dto);
    }

    public function updateImage()
    {

    }

    public function findImage(int $id)
    {
        return $this->repository->findImage($id);
    }

    public function deleteImage(int $id)
    {
        $image = $this->repository->deleteImage($id);
        // Delete the image file
        $url = str_replace('storage', '', strval($image->content));
        FileService::deleteFile($url);

        return $image;
    }
}
