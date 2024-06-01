<?php

namespace App\Models;

use App\Models\Users\User;
use App\Traits\Filterable;
use App\Traits\Ownable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use Filterable, HasFactory, SoftDeletes, Ownable;

    protected $table = 'books';

    protected $fillable = [
        'created_by',
        'updated_by'
    ];
    public function details() : HasMany
    {
        return $this->hasMany(related: BookDetails::class, foreignKey: 'book_id');
    }

    public function entities() : HasMany
    {
        return $this->hasMany(related: BookEntity::class, foreignKey: 'book_id');
    }

    public function creator() : BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'created_by');
    }

    public function updater() : BelongsTo
    {
        return $this->belongsTo(related: User::class, foreignKey: 'updated_by');
    }
}
