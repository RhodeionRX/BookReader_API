<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'books';
    public function localizations() : HasMany
    {
        return $this->hasMany(related: BookLocalInfo::class, foreignKey: 'book_id');
    }

    public function translations() : HasMany
    {
        return $this->hasMany(related: BookTranslation::class, foreignKey: 'book_id');
    }
}
