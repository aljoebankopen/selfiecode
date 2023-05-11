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
        Schema::create('selfieuser', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('otp_code',6)->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('is_locked')->default(false);
            $table->integer('attempt_count')->default(0);
            $table->dateTime('last_attempt_time')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('selfieuser');
    }
};
