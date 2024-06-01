<?php

namespace App\Repositories\Role;

use App\Enums\Users\RoleEnum;
use App\Models\Users\Role;
use App\Models\Users\User;

interface IRoleRepositoryInterface
{
    public function add(User $user, Role $role);
    public function remove(User $user, Role $role);
    public function find(RoleEnum $role);
}
