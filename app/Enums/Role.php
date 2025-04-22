<?php

namespace App\Enums;

enum Role: string
{
    case Admin = 'admin';
    case Logistics = 'logistics';
    case User = 'user';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
