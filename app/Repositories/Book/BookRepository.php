<?php

namespace App\Repositories\Book;

use App\DTO\Book\AddImageDTO;
use App\DTO\Book\AddDetailsDTO;
use App\DTO\Book\UpdateBookDTO;
use App\DTO\Book\UpdateImageDTO;
use App\Enums\ImageStatusEnum;
use App\Enums\LanguagesEnum;
use App\Models\Book;
use App\Models\BookImage;
use App\Models\BookDetails;
use App\Repositories\BaseRepository;
use stdClass;
class BookRepository implements BookRepositoryInterface
{
    // Books
    public function create()
    {
        return Book::create();
    }

    public function find(int $id)
    {
        return Book::withTrashed()->with('details.images')->findOrFail($id);
    }

    public function findAll()
    {
        return Book::with('details.images')->get();
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

    public function update(BookDetails $localization, UpdateBookDTO $dto)
    {
        $localization->title = $dto->title;
        $localization->description = $dto->description;
        $localization->save();

        return $localization;
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
