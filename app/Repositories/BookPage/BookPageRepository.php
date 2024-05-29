<?php

namespace App\Repositories\BookPage;

use App\DTO\BookEntity\StoreBookPageDTO;
use App\DTO\BookEntity\UpdateBookPageDTO;
use App\Models\BookPage;
use App\Repositories\BaseRepository;

class BookPageRepository implements IBookPageRepositoryInterface
{
    public function __construct(BookPage $page) {
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

        return $page;
    }

    public function find(int $entity_id, int $number)
    {
        return BookPage::where('entity_id', $entity_id)
            ->where(function ($query) use ($number) {
                $query->where('number', $number);
            })->first();
    }

    public function destroy(BookPage $page)
    {
        $page->delete();

        return $page;
    }
}
