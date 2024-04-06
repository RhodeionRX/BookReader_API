<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddLocalDTO;
use stdClass;

interface BookRepositoryInterface
{
    public function create();
    public function add(AddLocalDTO $dto);
}
