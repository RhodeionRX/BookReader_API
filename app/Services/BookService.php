<?php
namespace App\Services;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Exceptions\ApiException;
use App\Filters\BookFilter;
use App\Repositories\Book\IBookRepositoryInterface;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class BookService
{
    public function __construct(
        protected IBookRepositoryInterface $repository
    ) {}

    // Books
    public function getAll(BookFilter $filter)
    {
        return $this->repository->findAll($filter);
    }

    public function getOne(int $id)
    {
        try {
            return $this->repository->find($id);
        } catch (\Exception $e) {
            throw ApiException::Error($e->getMessage(), $e->getCode());
        }
    }
    public function create(Request $request)
    {
        $token = PersonalAccessToken::findToken($request->bearerToken());
        $user = $token->tokenable;
        return $this->repository->create($user);
    }
    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }

    // Localizations
    public function addDetails(AddDetailsDTO $dto)
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
        // Check if there is any images for the book
        $candidates = $this->repository->findImagesByBook($dto->detail_id, $dto->language);

        // If it's the first image for this book then set up primary status for it.
        // However it's additional logic for the database trigger.
        if ($candidates->isEmpty())
        {
            return $this->repository->addImage(
                $dto,
                ImageStatusEnum::Primary
            );
        }

        return $this->repository->addImage($dto);
    }

    public function updateImage(int $id, UpdateImageDTO $dto)
    {
        return $this->repository->updateImage(
            $this->repository->findImage($id),
            $dto
        );
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
