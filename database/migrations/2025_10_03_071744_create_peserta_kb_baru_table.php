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
        Schema::create('peserta_kb_baru', function (Blueprint $table) {
            $table->id();
            $table->foreignId('posyandu_id')->constrained('posyandus')->onDelete('cascade');
            $table->string('nama_pasien');
            $table->date('tanggal_pelayanan');
            $table->enum('jenis_kontrasepsi', ['PIL', 'SUNTIK', 'KONDOM', 'IUD', 'IMPLAN', 'MOW', 'MOP']);
            $table->enum('jalur_layanan', ['UMUM', 'BPJS/K', 'PASCA SALIN']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peserta_kb_baru');
    }
};