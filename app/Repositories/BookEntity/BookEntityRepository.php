<?php

namespace App\Repositories\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;
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
        // TODO: Implement all() method.
    }

    public function show(int $id)
    {
        // TODO: Implement show() method.
    }

    public function update(StoreBookEntityDTO $dto)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $id)
    {
        // TODO: Implement delete() method.
    }
}
