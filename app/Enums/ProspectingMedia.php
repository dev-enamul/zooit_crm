<?php

namespace App\Enums;

final class ProspectingMedia
{
    const Phone = "1";
    const Meet  = "2";

    public static function values()
    {
        return [
            self::Phone => 'Phone',
            self::Meet  => 'Meet',
        ];
    }
}
