<?php
namespace App\Services;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Exceptions\ApiException;
use App\Models\Book;
use App\Models\BookLocalInfo;
use App\Repositories\Book\BookRepositoryInterface;
use Illuminate\Http\Response;
use stdClass;

class BookService
{
    public function __construct(
        protected BookRepositoryInterface $repository
    ) {}
    public function init()
    {
        return $this->repository->create();
    }

    public function createLocalization(AddLocalDTO $dto)
    {
        return $this->repository->add($dto);
    }

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

    public function update(int $id, UpdateBookDTO $dto)
    {
        $localization = $this->repository->findLocalization($id);
        return $this->repository->update($localization, $dto);
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
