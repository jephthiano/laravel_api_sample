<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('otp_codes', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('receiving_medium')->unique();
            $table->string('code');
            $table->enum('use_case', ['sign_up', 'forgot_password', 'verify_email']);
            $table->enum('status', ['new', 'used'])->default('new');
            $table->timestamps();

            $table->index('receiving_medium');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};
