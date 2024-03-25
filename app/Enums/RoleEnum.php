<?php

declare(strict_types=1);

namespace App\Enums;

enum RoleEnum: string {
    case User = 'user';
    case Admin = 'admin';
    case Editor = 'editor';
    case SuperUser = 'super-user';
}
