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
    ) {

    }
    public function init() : stdClass
    {
        return $this->repository->create();
    }

    public function createLocalization(AddLocalDTO $dto) : stdClass
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
            return $this->repository->find($id); //Book::with('localizations')->where('id', $id)->firstOrFail();
        } catch (\Exception $e) {
            throw ApiException::Error(
                $e->getMessage() ?: 'Unknown error',
                $e->getCode()?: Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    public function update(int $id, UpdateBookDTO $dto)
    {
        $localization = BookLocalInfo::findOrFail($id);
        $localization->title = $dto->title;
        $localization->description = $dto->description;

        $localization->save();

        return $localization;
    }

    public function destroy(int $id)
    {
        return $this->repository->destroy($id);
    }
}
