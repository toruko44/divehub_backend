<?php

namespace App\Enums;

use App\Utils\EnumToSelectHelper;

enum TagType :string
{
    use EnumToSelectHelper;

    case CREATURE = 'creature';
    case SPOT = 'spot';
    case SHOP = 'shop';
    case EQUIPMENT = 'equipment';
    case BEGINNER = 'beginner';
    case CAMERA = 'camera';
    case SKILL = 'skill';

    public function label(): string
    {
        return match ($this) {
            self::CREATURE => '生き物',
            self::SPOT => 'スポット',
            self::SHOP => 'ショップ',
            self::EQUIPMENT => '機材',
            self::BEGINNER => '初心者',
            self::CAMERA => 'カメラ',
            self::SKILL => 'スキル',
        };
    }
}
