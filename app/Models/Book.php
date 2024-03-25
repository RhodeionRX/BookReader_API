<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    protected $table = 'books';
    public function locals() : HasMany
    {
        return $this->hasMany(related: BookLocalInfo::class, foreignKey: 'book_id');
    }

    public function translations() : HasMany
    {
        return $this->hasMany(related: BookTranslation::class, foreignKey: 'book_id');
    }
}
