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
            $table->uuid('id')->primary('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('age');
            $table->string('cpf')->unique();
            $table->string('type')->default('CLIENTE');

            $table->boolean('email_verified')->default(false);
            $table->string('email_verification_token')->nullable();

            $table->string('token_forget_password')->nullable();

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
