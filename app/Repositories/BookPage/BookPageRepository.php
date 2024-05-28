<?php

namespace App\Repositories\BookPage;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Models\BookPage;
use App\Repositories\BaseRepository;

class BookPageRepository extends BaseRepository implements IBookPageRepositoryInterface
{
    public function __construct(BookPage $page) {
        parent::__construct($page);
    }

    public function create(StoreBookPageDTO $dto)
    {
        return BookPage::create([
            'number' => $dto->number,
            'content' => $dto->content,
            'entity_id' => $dto->entity_id
        ]);
    }

    public function update(BookPage $page, UpdateBookPageDTO $dto)
    {
        $page->update([
            'content' => $dto->content,
        ]);
    }
}
