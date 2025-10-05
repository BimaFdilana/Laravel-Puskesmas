<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanComments extends Command
{
    protected $signature = 'clean:comments';
    protected $description = 'Hapus komentar di Controller, Model, Route, dan View';

    public function handle()
    {
        $this->info('🔍 Memulai proses hapus komentar...');

        $targetPaths = [
            base_path('app/Http/Controllers'),
            base_path('app/Models'),
            base_path('routes'),
            base_path('resources/views'),
        ];

        foreach ($targetPaths as $path) {
            if (!File::exists($path)) continue;

            $files = File::allFiles($path);

            foreach ($files as $file) {
                $filePath = $file->getPathname();
                $content = File::get($filePath);

                // Hapus komentar PHP & Blade
                $newContent = preg_replace([
                    '/\/\/.*|#.*|\/\*[\s\S]*?\*\//', // PHP comments
                    '/\{\{--[\s\S]*?--\}\}/',        // Blade comments
                ], '', $content);

                if ($newContent !== $content) {
                    File::put($filePath, $newContent);
                    $this->line("🧹 Dibersihkan: {$filePath}");
                }
            }
        }

        $this->info('✅ Semua komentar di API, Controller, Model, dan View berhasil dihapus!');
    }
}