<?php

namespace App\Enums;

use App\Utils\EnumToSelectHelper;

enum LicenseType :string
{
    use EnumToSelectHelper;

    case NOVICE = 'novice';
    case OPEN = 'open';
    case ADVANCE = 'advance';
    case SPECIAL = 'special';
    case MASTER = 'master';
    case INSTRUCTOR = 'instructor';

    public function label(): string
    {
        return match ($this) {
            self::NOVICE => '未経験者',
            self::OPEN => 'オープンウォーター',
            self::ADVANCE => 'アドバンス',
            self::SPECIAL => 'スペシャリティ',
            self::MASTER => 'マスター',
            self::INSTRUCTOR => 'インストラクター',
        };
    }
}
