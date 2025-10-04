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
    Schema::table('posyandus', function (Blueprint $table) {
        $table->dropUnique('posyandus_nama_posyandu_unique');

        $table->unique(['user_id', 'nama_posyandu']);
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posyandus', function (Blueprint $table) {
            $table->dropUnique('posyandus_nama_posyandu_unique');

            $table->unique(['nama_posyandu']);
        });
    }
};
