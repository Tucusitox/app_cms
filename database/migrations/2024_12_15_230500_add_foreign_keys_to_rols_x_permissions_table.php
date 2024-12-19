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
        Schema::table('rols_x_permissions', function (Blueprint $table) {
            $table->foreign(['fk_permission'], 'fk_permissions_has_rols_permissions')->references(['id_permission'])->on('permissions')->onUpdate('no action')->onDelete('no action');
            $table->foreign(['fk_rol'], 'fk_permissions_has_rols_rols1')->references(['id_rol'])->on('rols')->onUpdate('no action')->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('rols_x_permissions', function (Blueprint $table) {
            $table->dropForeign('fk_permissions_has_rols_permissions');
            $table->dropForeign('fk_permissions_has_rols_rols1');
        });
    }
};