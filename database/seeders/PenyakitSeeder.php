<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Penyakit;

class PenyakitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // PERBAIKAN: Matikan pengecekan foreign key sebelum truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Mengosongkan tabel
        Penyakit::truncate();

        // HIDUPKAN KEMBALI pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $daftarPenyakit = [
            'Kolera',
            'Diare',
            'Diare berdarah',
            'Tifus perut klinis',
            'TBC paru BTA(+)',
            'Tersangka TBC paru',
            'Kusta PB',
            'Kusta MB',
            'Campak',
            'Difteri',
            'Batuk rejan',
            'Tetanus',
            'Hepatitis klinis',
            'Malaria klinis',
            'Malaria vivax',
            'Malaria falsifarum',
            'Malaria mix',
            'Demam berdarah dengue',
            'Demam dengue',
            'Pneumonia',
            'Sifilis',
            'Gonorrhoe',
            'Frambusia',
            'Filariasis',
            'Influensa (H1N1)',
            'Diabetes Mellitus',
            'Hipertensi',
            'ISPA',
        ];

        foreach ($daftarPenyakit as $nama) {
            Penyakit::create(['nama_penyakit' => $nama]);
        }
    }
}