<?php

namespace App\Repositories\BookEntity;

use App\DTO\BookEntity\StoreBookEntityDTO;

interface IBookEntityRepositoryInterface
{
    public function create(StoreBookEntityDTO $dto);
    public function all();
    public function show(int $id);
    public function update(StoreBookEntityDTO $dto);
    public function delete(int $id);
}
