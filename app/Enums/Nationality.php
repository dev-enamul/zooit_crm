<?php

namespace App\Enums;

final class Nationality
{
    const Bangladeshi = "0";
    const Indian      = "1";

    public static function values()
    {
        return [
            self::Bangladeshi   => 'Bangladeshi',
            self::Indian        => 'Indian',
        ];
    }
}
