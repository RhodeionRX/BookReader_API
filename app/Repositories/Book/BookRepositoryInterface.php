<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Models\BookLocalInfo;
use stdClass;

interface BookRepositoryInterface
{
    public function find(int $id);
    public function findLocalization(int $id);
    public function findAll();
    public function create();
    public function addLocalization(AddLocalDTO $dto);
    public function update(BookLocalInfo $localization, UpdateBookDTO $dto);
    public function destroy(int $id);
}
