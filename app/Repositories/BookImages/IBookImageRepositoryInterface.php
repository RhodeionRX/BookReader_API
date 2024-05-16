<?php

namespace App\Repositories\BookImages;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Models\BookImage;

interface IBookImageRepositoryInterface
{
    // Images
    public function create(AddImageDTO $dto, ?ImageStatusEnum $status);
    public function update(BookImage $image, UpdateImageDTO $dto);
    public function destroy(int $id);
}
