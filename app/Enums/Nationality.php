<?php

namespace App\Enums;

final class Nationality
{
    const Bangladeshi = "1";
    const Indian      = "0";

    public static function values()
    {
        return [
            self::Bangladeshi   => 'Bangladeshi',
            self::Indian        => 'Indian',
        ];
    }
}
