<?php

namespace App\Models;

use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BookTranslation extends Model
{
    use HasFactory;

    protected $table = 'book_translations';

    protected $fillable = [
        'title',
        'description',
        'book_id'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(related: Book::class, foreignKey: 'book_id');
    }

    public function lines() : HasMany
    {
        return $this->hasMany(related: TextLine::class, foreignKey: 'translation_id');
    }
}
