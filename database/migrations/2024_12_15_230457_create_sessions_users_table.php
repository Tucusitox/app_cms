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
        Schema::create('sessions_users', function (Blueprint $table) {
            $table->integer('id_sessionUser', true);
            $table->integer('fk_user')->index('fk_sessions_users_users1_idx');
            $table->string('session_status', 100);
            $table->date('session_date');
            $table->time('session_time_start');
            $table->time('session_time_closing')->nullable();
            $table->time('session_duration')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions_users');
        Schema::dropIfExists('sessions');
    }
};
