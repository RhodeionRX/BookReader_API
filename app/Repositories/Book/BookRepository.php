<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddLocalDTO;
use App\Models\Book;
use App\Models\BookLocalInfo;
use App\Repositories\BaseRepository;
use stdClass;
class BookRepository extends BaseRepository implements BookRepositoryInterface
{
    protected BookLocalInfo $localization;
    public function __construct(Book $book, BookLocalInfo $localization)
    {
        parent::__construct($book);
        $this->localization = $localization;
    }
    public function create() : stdClass
    {
        return (object) $this->model->create()->toArray();
    }


    public function add(AddLocalDTO $dto) : stdClass
    {
        return (object) $this->localization->create([
            'title' => $dto->title,
            'description' => $dto->description,
            'language' => $dto->language,
            'book_id' => $dto->book_id
        ])->toArray();
    }
    public function find(int $id) : ?array
    {
        return $this->model->findOrFail($id)?->toArray();
    }

    public function findAll() : ?array
    {
        return $this->model->all()->toArray();
    }
}
