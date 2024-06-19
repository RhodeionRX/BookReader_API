<?php

namespace App\Policies;

use App\Models\BookDetails;
use App\Models\Users\User;
use Illuminate\Http\Client\Request;

class BookDetailsPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function add(?User $user = null, ?Request $request = null): bool
    {
        dd($request);
        if ($bookDetail->book()->created_by === $user?->id) return true;
        else return false;
        // TODO Add book editor group condition
    }

    public function update(?User $user, BookDetails $bookDetail)
    {
        if ($bookDetail->book()->created_by === $user?->id) return true;
        else return false;
    }
}
