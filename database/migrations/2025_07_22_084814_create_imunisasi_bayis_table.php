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
        Schema::create('imunisasi_bayi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_bayi');
            $table->string('nama_posyandu');
            $table->string('nama_orang_tua');
            $table->date('tanggal_lahir');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jenis_imunisasi')->nullable();
            $table->text('alamat_lengkap');
            $table->string('nik_orang_tua')->nullable();
            $table->string('nik_bayi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('imunisasi_bayi');
    }
};