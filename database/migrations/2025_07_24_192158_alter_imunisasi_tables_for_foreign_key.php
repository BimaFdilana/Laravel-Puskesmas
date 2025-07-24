<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Mengubah tabel imunisasi_bayi
        Schema::table('imunisasi_bayi', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_imunisasi_id')->nullable()->after('jenis_kelamin');
            $table->foreign('jenis_imunisasi_id')->references('id')->on('jenis_imunisasi')->onDelete('set null');
            $table->dropColumn('jenis_imunisasi');
        });

        // Mengubah tabel imunisasi_wus_bumil
        Schema::table('imunisasi_wus_bumil', function (Blueprint $table) {
            $table->unsignedBigInteger('jenis_imunisasi_id')->nullable()->after('hamil_ke');
            $table->foreign('jenis_imunisasi_id')->references('id')->on('jenis_imunisasi')->onDelete('set null');
            $table->dropColumn('jenis_imunisasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Mengembalikan perubahan pada tabel imunisasi_bayi
        Schema::table('imunisasi_bayi', function (Blueprint $table) {
            $table->string('jenis_imunisasi')->nullable();
            $table->dropForeign(['jenis_imunisasi_id']);
            $table->dropColumn('jenis_imunisasi_id');
        });

        // Mengembalikan perubahan pada tabel imunisasi_wus_bumil
        Schema::table('imunisasi_wus_bumil', function (Blueprint $table) {
            $table->string('jenis_imunisasi');
            $table->dropForeign(['jenis_imunisasi_id']);
            $table->dropColumn('jenis_imunisasi_id');
        });
    }
};