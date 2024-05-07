<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    use HasFactory;

    protected $table = 'page';

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
