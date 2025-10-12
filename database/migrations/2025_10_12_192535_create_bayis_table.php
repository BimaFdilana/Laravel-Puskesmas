    <?php

    use Illuminate\Database\Migrations\Migration;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Support\Facades\Schema;

    return new class extends Migration
    {
        public function up(): void
        {
            Schema::create('bayis', function (Blueprint $table) {
                $table->id();
                $table->string('nama_bayi');
                $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
                $table->timestamps();
                $table->unique(['nama_bayi', 'user_id']);
            });
        }

        public function down(): void
        {
            Schema::dropIfExists('bayis');
        }
    };
