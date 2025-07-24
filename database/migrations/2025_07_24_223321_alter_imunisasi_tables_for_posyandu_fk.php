<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Mengubah tabel imunisasi_bayi
        Schema::table('imunisasi_bayi', function (Blueprint $table) {
            $table->unsignedBigInteger('posyandu_id')->nullable()->after('id');
            $table->foreign('posyandu_id')->references('id')->on('posyandus')->onDelete('set null');
            $table->dropColumn('nama_posyandu');
        });

        // Mengubah tabel imunisasi_wus_bumil
        Schema::table('imunisasi_wus_bumil', function (Blueprint $table) {
            $table->unsignedBigInteger('posyandu_id')->nullable()->after('id');
            $table->foreign('posyandu_id')->references('id')->on('posyandus')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('imunisasi_bayi', function (Blueprint $table) {
            $table->string('nama_posyandu');
            $table->dropForeign(['posyandu_id']);
            $table->dropColumn('posyandu_id');
        });

        Schema::table('imunisasi_wus_bumil', function (Blueprint $table) {
            $table->dropForeign(['posyandu_id']);
            $table->dropColumn('posyandu_id');
        });
    }
};