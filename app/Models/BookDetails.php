<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookDetails extends Model
{
    use HasFactory, SoftDeletes, Filterable;

    protected $table = 'book_details';
    protected $fillable = [
        'title',
        'description',
        'language',
        'book_id'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(related: Book::class, foreignKey: 'book_id');
    }

    public function images() : HasMany
    {
        return $this->hasMany(related: BookImage::class, foreignKey: 'detail_id');
    }
}
