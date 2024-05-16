<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Filters\BookFilter;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookDetails;
use App\Models\User;
use App\Repositories\BaseRepository;

class BookRepository extends BaseRepository implements IBookRepositoryInterface
{
    public function __construct(Book $book) {
        parent::__construct($book);
    }

    // Books
    public function create(User $user)
    {
        return Book::create([
            'created_by' => $user->id,
            'updated_by' => $user->id
        ]);
    }

    public function destroy(int $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return $book;
    }

    // Localizations
    public function addLocalization(AddDetailsDTO $dto)
    {
        return BookDetails::create([
            'title' => $dto->title,
            'description' => $dto->description,
            'language' => $dto->language,
            'book_id' => $dto->book_id
        ]);
    }

    public function findLocalization(int $id)
    {
        return BookDetails::findOrFail($id);
    }

    public function update(BookDetails $localization, UpdateBookDTO $dto, User $user)
    {
        $localization->title = $dto->title;
        $localization->description = $dto->description;
        $localization->save();

        $this->setUpdater($localization->book_id, $user->id);

        return $localization;
    }

    private function setUpdater(int $book_id, int $user_id)
    {
        $book = $this->find($book_id);
        $book->updated_by = $user_id;
        $book->save();
    }

    // Images
    public function addImage(
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

    public function findImage(int $id)
    {
        return BookImage::findOrFail($id);
    }

    public function findImagesByBook(int $detail_id)
    {
        return BookImage::where('detail_id', $detail_id)->get();
    }

    public function updateImage(BookImage $image, UpdateImageDTO $dto)
    {
        if (!empty($dto->content)) $image->content = $dto->content;
        if (!empty($dto->status)) $image->status = $dto->status;
        $image->save();

        return $image;
    }

    public function deleteImage(int $id)
    {
        $image = BookImage::findOrFail($id);
        $image->delete();
        return $image;
    }
}
