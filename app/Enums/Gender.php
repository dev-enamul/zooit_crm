<?php

namespace App\Enums;

final class Gender
{
    const Male = "1";
    const Female = "2";

    public static function values()
    {
        return [
            self::Male => 'Male',
            self::Female => 'Female',
        ];
    }
}
