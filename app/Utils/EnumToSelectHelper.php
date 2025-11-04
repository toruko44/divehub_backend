<?php

namespace App\Utils;

trait EnumToSelectHelper
{
    abstract public function label(): string;

    public static function toSelectArray(): array
    {
        $list = [];
        foreach (static::cases() as $case) {
            $list[$case->value] = $case->label();
        }
        return $list;
    }

    public static function values(): array {
        return array_column(self::cases(), 'value');
    }
}