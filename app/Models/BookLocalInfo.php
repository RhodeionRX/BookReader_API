<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookLocalInfo extends Model
{
    use HasFactory;

    protected $table = 'book_local_infos';
    protected $fillable = [
        'title',
        'description',
        'language_id',
        'book_id'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(related: Book::class, foreignKey: 'book_id');
    }

    public function language() : BelongsTo
    {
        return $this->belongsTo(related: Language::class, foreignKey: 'language_id');
    }
}
