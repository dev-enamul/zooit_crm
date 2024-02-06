<?php

namespace App\Enums;

final class ProgressStatus
{
    const Running = "1";
    const Complete = "0";

    public static function values()
    {
        return [
            self::Running => 'Running',
            self::Complete => 'Complete',
        ];
    }
}
