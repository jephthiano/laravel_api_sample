<?php

namespace App\Enums;

enum OtpCodeUseCase: string
{
    case SignUp = 'sign_up';
    case ForgotPassword = 'forgot_password';
    case VerifyEmail = 'verify_email';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }
}
