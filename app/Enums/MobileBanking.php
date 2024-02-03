<?php

namespace App\Enums;

final class MobileBanking
{
    const BKash     = "1";
    const Rocket    = "2";
    const MCash     = "3";

    public static function values()
    {
        return [
            self::BKash     => 'BKash',
            self::Rocket    => 'Rocket',
            self::MCash     => 'MCash',
        ];
    }
}
