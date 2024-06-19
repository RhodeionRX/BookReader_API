<?php

namespace App\Policies;

use App\Models\Book;
use App\Models\Users\User;

class BookPolicy
{
    public function update(?User $user, ?Book $book)
    {
        return $user?->id === $book->created_by;
    }

    public function destroy(?User $user, Book $book)
    {
        return $user?->id === $book->created_by;
    }
}
