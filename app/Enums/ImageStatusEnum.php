<?php
declare(strict_types=1);

namespace App\Enums;

use App\Traits\EnumToArray;

enum ImageStatusEnum: string {
    use EnumToArray;
    case Primary = 'Primary';
    case Additional = 'Additional';
}
