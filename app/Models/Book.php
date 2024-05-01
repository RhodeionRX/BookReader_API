<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'books';
    public function details() : HasMany
    {
        return $this->hasMany(related: BookDetails::class, foreignKey: 'book_id');
    }

    public function translations() : HasMany
    {
        return $this->hasMany(related: BookEntity::class, foreignKey: 'book_id');
    }
}
