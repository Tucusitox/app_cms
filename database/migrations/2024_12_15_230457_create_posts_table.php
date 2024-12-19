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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id_post', true);
            $table->integer('fk_user')->index('fk_posts_users1_idx');
            $table->string('post_img', 200);
            $table->string('post_tittle', 100);
            $table->string('post_body', 10000);
            $table->date('post_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
