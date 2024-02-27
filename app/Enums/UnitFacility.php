<?php

namespace App\Enums;

final class UnitFacility
{
    const WithFinishing = "1";
    const WithoutFinishing = "2";

    public static function values()
    {
        return [
            self::WithFinishing => 'WithFinishing',
            self::WithoutFinishing => 'WithoutFinishing',
        ];
    }
}
