<?php

namespace App\Repositories\Role;

use App\Enums\Users\RoleEnum;
use App\Models\Users\Role;
use App\Models\Users\User;
use App\Models\Users\UserRole;

class RoleRepository implements IRoleRepositoryInterface
{

    public function add(User $user, Role $role)
    {
        $user->roles()->attach($role);
    }

    public function remove(User $user, Role $role)
    {
        $user->roles()->detach($role);
    }

    public function find(RoleEnum $role)
    {
        return Role::where('code', $role->value)->first();
    }
}
