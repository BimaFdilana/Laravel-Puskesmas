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
        Schema::create('anc_records', function (Blueprint $table) {
            $table->id();
            $table->string('rekam_medis');
            $table->string('kohort');
            $table->string('nama_pasien');
            $table->string('alamat');
            $table->string('nik');
            $table->string('petugas');

            $table->json('k1')->nullable();
            $table->json('k2')->nullable();
            $table->json('k3')->nullable();
            $table->json('k4')->nullable();
            $table->json('k5')->nullable();
            $table->json('k6')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('anc_records');
    }
};
