<?php

namespace App\Enums\Users;

use App\Traits\EnumToArray;

enum RoleEnum: string {
    use EnumToArray;

    case User = 'user';
    case Admin = 'admin';
    case SuperUser = 'super-user';
}
