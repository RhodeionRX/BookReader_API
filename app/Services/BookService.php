<?php
namespace App\Services;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Exceptions\ApiException;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookLocalInfo;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Http\Response;
use stdClass;

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
        return $this->repository->addImage($dto);
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
