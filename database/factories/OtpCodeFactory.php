<?php

namespace Database\Factories;

use App\Models\OtpCode;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use App\Enums\OtpCodeStatus;
use App\Enums\OtpCodeUseCase;

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
