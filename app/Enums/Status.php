<?php

namespace App\Enums;

final class Status
{
    const Active = "Active";
    const Inactive = "Inactive";

    public static function values()
    {
        return [
            self::Active,
            self::Inactive,
        ];
    }
}
