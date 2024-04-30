<?php

namespace App\Repositories\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
use App\DTO\BookEntity\UpdateBookEntityDTO;
use App\Models\BookEntity;

class BookEntityRepository implements IBookEntityRepositoryInterface
{

    public function create(StoreBookEntityDTO $dto)
    {
        return BookEntity::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'book_id' => $dto->book_id,
        ]);
    }

    public function all()
    {
        return BookEntity::all();
    }

    public function find(int $id)
    {
        return BookEntity::withTrashed()->findOrFail($id);
    }

    public function update(BookEntity $bookEntity, UpdateBookEntityDTO $dto)
    {
        $bookEntity->title = $dto->title;
        $bookEntity->description = $dto->description;
        $bookEntity->save();

        return $bookEntity;
    }

    public function delete(int $id)
    {
        $bookEntity = BookEntity::findOrFail($id);
        $bookEntity->delete();

        return $bookEntity;
    }
}
