<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable()->unique();
            $table->string('username')->unique();
            $table->string('country');
            $table->boolean('is_admin')->default(false);
            $table->enum('role', [
                'super_admin',
                'admin',
                'customer_rep',
                'product_manager',
                'warehouse_manager',
                'order_manager',
                'marketing_manager',
                'finance_manager',
                'shipping_manager',
                'content_manager',
                'affiliate_manager',
                'user',
            ])->default('user');
            $table->string('avatar')->nullable();
            $table->date('birthdate')->nullable();            
            $table->boolean('enable_2fa')->default(false);
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->enum('status', ['active', 'suspended'])->default('active');
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};



// // Creating an OTP
// OtpCode::create([
//     'receiving_medium' => 'user@example.com',
//     'code' => '123456',
//     'use_case' => 'verify_email',
// ]);

// // Checking a code
// $otp = OtpCode::where('use_case', 'verify_email')
//               ->valid()
//               ->get()
//               ->firstWhere(fn ($otp) => $otp->matchesCode('123456'));