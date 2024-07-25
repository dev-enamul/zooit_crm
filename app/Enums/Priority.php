<?php

namespace App\Enums;

final class Priority
{
    const Ziro  = "0";
    const Ten  = "10";
    const Twelve = "20";
    const Thirteen = "30";
    const Forty = "40";
    const Fifty = "50";
    const Sixty = "60";
    const Seventy = "70";
    const Eighty = "80";
    const Ninety = "90";
    const Hundred = "100";

    public static function values()
    {
        return [
            self::Ziro  => '0%',
            self::Ten  => '10%',
            self::Twelve => '20%',
            self::Thirteen => '30%',
            self::Forty  => '40%',
            self::Fifty  => '50%',
            self::Sixty  => '60%',
            self::Seventy  => '70%',
            self::Eighty  => '80%',
            self::Ninety  => '90%',
            self::Hundred  => '100%',
        ];
    }
}

