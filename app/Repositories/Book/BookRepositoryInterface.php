<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddLocalDTO;
use App\DTO\Book\UpdateBookDTO;
use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use App\Models\BookLocalInfo;
use stdClass;

interface BookRepositoryInterface
{
    // Books
    public function find(int $id);
    public function findAll();
    public function create();
    public function destroy(int $id);

    // Localizations
    public function findLocalization(int $id);
    public function addLocalization(AddLocalDTO $dto);
    public function update(BookLocalInfo $localization, UpdateBookDTO $dto);

    // Images
    public function addImage(AddImageDTO $dto, ?string $status);
    public function findImage(int $id);
    public function findImagesByBook(int $book_id);
    public function deleteImage(int $id);
}
