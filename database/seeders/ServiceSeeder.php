<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Hapus data lama untuk menghindari duplikasi saat seeding ulang
        Service::truncate();

        $services = [
            [
                'icon' => 'fa fa-heartbeat',
                'title' => 'Kardiologi',
                'description' => 'Pelayanan kesehatan jantung untuk diagnosis, pengobatan, dan pencegahan penyakit kardiovaskular secara menyeluruh.',
            ],
            [
                'icon' => 'fa fa-x-ray',
                'title' => 'Paru (Pulmonologi)',
                'description' => 'Layanan medis untuk pemeriksaan dan penanganan penyakit paru-paru dan sistem pernapasan.',
            ],
            [
                'icon' => 'fa fa-brain',
                'title' => 'Neurologi',
                'description' => 'Penanganan berbagai gangguan sistem saraf seperti stroke, epilepsi, dan gangguan fungsi otak.',
            ],
            [
                'icon' => 'fa fa-wheelchair',
                'title' => 'Ortopedi',
                'description' => 'Pelayanan untuk masalah tulang, sendi, otot, dan rehabilitasi cedera fisik secara medis.',
            ],
            [
                'icon' => 'fa fa-tooth',
                'title' => 'Bedah Gigi',
                'description' => 'Pelayanan bedah mulut dan perawatan gigi lanjutan oleh tenaga medis profesional.',
            ],
            [
                'icon' => 'fa fa-vials',
                'title' => 'Laboratorium',
                'description' => 'Layanan pemeriksaan laboratorium untuk mendukung diagnosa dan pemantauan kondisi kesehatan pasien.',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}