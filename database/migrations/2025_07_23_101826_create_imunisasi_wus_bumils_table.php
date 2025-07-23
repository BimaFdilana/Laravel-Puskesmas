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
        Schema::create('imunisasi_wus_bumil', function (Blueprint $table) {
            $table->id();
            $table->string('nama_wus_bumil');
            $table->string('nama_suami');
            $table->unsignedInteger('umur');
            $table->unsignedInteger('hamil_ke')->nullable();
            $table->string('jenis_imunisasi');
            $table->text('alamat_lengkap');
            $table->string('nik')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasi_wus_bumil');
    }
};
