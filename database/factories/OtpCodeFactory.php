<?php

namespace Database\Factories;

use App\Enums\OtpCodeStatus;
use App\Enums\OtpCodeUseCase;
use App\Models\OtpCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OtpCodeFactory extends Factory
{
    protected $model = OtpCode::class;

    public function definition()
    {
        $useCase = OtpCodeUseCase::values();

        return [
            'code' => Str::random(6),
            'use_case' => $this->faker->randomElement($useCase),
            'receiving_medium' => $this->faker->safeEmail(),
            'status' => otpCodeStatus::New->value,
        ];
    }
}
