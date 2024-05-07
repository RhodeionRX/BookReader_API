<?php

namespace App\Models;

use Faker\Provider\Text;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookEntity extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'book_entity';

    protected $fillable = [
        'title',
        'description',
        'book_id'
    ];

    public function book() : BelongsTo
    {
        return $this->belongsTo(related: Book::class, foreignKey: 'book_id');
    }

    public function pages() : HasMany
    {
        return $this->hasMany(related: Page::class, foreignKey: 'entity_id');
    }
}
