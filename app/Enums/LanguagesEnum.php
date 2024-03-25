<?php

declare(strict_types=1);

namespace App\Enums;
use App\Traits\EnumToArray;

enum LanguagesEnum: string {
    use EnumToArray;
    case En = 'ENG';
    case Ru = 'RUG';
    case Pl = 'POL';
    case Ua = 'UKR';
}
