<?php

namespace App\Repositories\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Models\BookEntity;
use App\Repositories\BaseRepository;

class BookEntityRepository extends BaseRepository implements IBookEntityRepositoryInterface
{
    public function __construct(BookEntity $bookEntity)
    {
        parent::__construct($bookEntity);
    }

    public function create(StoreBookEntityDTO $dto)
    {
        return BookEntity::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'book_id' => $dto->book_id,
        ]);
    }

    public function update(BookEntity $bookEntity, UpdateBookEntityDTO $dto)
    {
        $bookEntity->title = $dto->title;
        $bookEntity->description = $dto->description;
        $bookEntity->save();

        return $bookEntity;
    }
}
