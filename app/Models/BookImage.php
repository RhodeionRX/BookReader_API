<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookImage extends Model
{
    use HasFactory;

    protected $table = 'book_images';
    protected $fillable = [
        'content',
        'status',
        'language',
        'book_id'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(related: Book::class, foreignKey: 'book_id');
    }
}
