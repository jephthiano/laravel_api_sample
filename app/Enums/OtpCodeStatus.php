<?php

namespace App\Enums;

enum OtpCodeStatus: string
{
    case New = 'new';
    case Used = 'used';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
