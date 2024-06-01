<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    protected $table = 'roles';

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class)->using(UserRole::class);
    }

}
