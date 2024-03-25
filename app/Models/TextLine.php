<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TextLine extends Model
{
    use HasFactory;

    protected $table = 'text_lines';

    protected $fillable = [
        'key',
        'content',
        'translation_id',
    ];

    public function translations() : BelongsTo
    {
        return $this->belongsTo(related: BookTranslation::class, foreignKey: 'translation_id');
    }
}
