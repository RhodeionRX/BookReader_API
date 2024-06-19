<?php

namespace App\Repositories\BookImages;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Models\Book;
use App\Models\BookImage;
use App\Repositories\BaseRepository;

class BookImageRepository extends BaseRepository implements IBookImageRepositoryInterface
{
    public function __construct(BookImage $image) {
        parent::__construct($image);
    }

    public function create(
        AddImageDTO $dto,
        ?ImageStatusEnum $status = ImageStatusEnum::Additional
    )
    {
        return BookImage::create([
                'content' => $dto->content,
                'status' => $status->value,
                'detail_id' => $dto->detail_id
            ]
        );
    }

    public function update(BookImage $image, UpdateImageDTO $dto)
    {
        $image->content = $dto->content;
        $image->status = $dto->status;
        $image->save();

        return $image;
    }
}
