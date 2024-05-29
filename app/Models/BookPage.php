<?php

namespace App\Models;

use App\Traits\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookPage extends Model
{
    use HasFactory, HasCompositeKey;

    protected $table = 'book_page';
    protected $primaryKey = ['entity_id', 'number'];
    public $incrementing = false;

    protected $fillable = [
        'number',
        'content',
        'entity_id',
    ];

    public function entity() : BelongsTo
    {
        return $this->belongsTo(related: BookEntity::class, foreignKey: 'entity_id');
    }
}
