<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookLocalInfo extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'book_local_infos';
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
}
