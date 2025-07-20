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
        Schema::table('berandas', function (Blueprint $table) {
            $table->string('contact_address')->nullable()->after('contact_email');
            $table->text('google_maps_link')->nullable()->after('contact_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('berandas', function (Blueprint $table) {
            $table->dropColumn(['contact_address', 'google_maps_link']);
        });
    }
};