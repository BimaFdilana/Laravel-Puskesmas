<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('berandas', function (Blueprint $table) {
            $table->id();

            // Hero Section
            // Dihapus: ->default(...) dari kolom TEXT
            $table->string('hero_title')->default('Web Puskesmas Meskom');
            $table->text('hero_subtitle'); // FIX: default value removed

            // About Us Section
            // Dihapus: ->default(...) dari kolom TEXT
            $table->string('about_title')->default('Why You Should Trust Us? Get Know About Us!');
            $table->text('about_description'); // FIX: default value removed
            $table->text('about_points')->comment('Simpan poin-poin sebagai teks, pisahkan dengan baris baru');
            $table->string('about_image_1')->nullable();
            $table->string('about_image_2')->nullable();

            // Features Section
            // Dihapus: ->default(...) dari kolom TEXT
            $table->string('feature_title')->default('Why Choose Us');
            $table->text('feature_description'); // FIX: default value removed
            $table->string('feature_image')->nullable();

            // Appointment Section
            // Dihapus: ->default(...) dari kolom TEXT
            $table->string('appointment_title')->default('Make An Appointment To Visit Our Doctor');
            $table->text('appointment_description'); // FIX: default value removed
            $table->string('contact_phone')->nullable();
            $table->string('contact_email')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('berandas');
    }
};