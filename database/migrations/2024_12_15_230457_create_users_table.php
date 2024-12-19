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
            $table->integer('user_id', true);
            $table->integer('fk_rol')->index('fk_users_rols1_idx');
            $table->string('user_name', 100);
            $table->string('email', 200)->unique('email_unique');
            $table->string('password', 100);
            $table->string('email_verified', 50);
            $table->string('user_token', 100)->unique('user_token_unique');
            $table->string('user_status', 100)->nullable();
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
