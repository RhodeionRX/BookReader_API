<?php

declare(strict_types=1);

namespace App\Enums;
use App\Traits\EnumToArray;

enum LanguagesEnum: string {
    use EnumToArray;
    case Eng = 'ENG';
    case Rus = 'RUS';
    case Pol = 'POL';
}
