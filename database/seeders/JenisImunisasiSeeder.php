<?php

namespace Database\Seeders;

use App\Models\JenisImunisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisImunisasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('jenis_imunisasi')->delete();

        $imunisasi = [
            ['nama_imunisasi' => 'HBO'],
            ['nama_imunisasi' => 'BCG'],
            ['nama_imunisasi' => 'Polio 1'],
            ['nama_imunisasi' => 'DPTHBHIB 1'],
            ['nama_imunisasi' => 'Polio 2'],
            ['nama_imunisasi' => 'DPTHBHIB 2'],
            ['nama_imunisasi' => 'Polio 3'],
            ['nama_imunisasi' => 'DPTHBHIB 3'],
            ['nama_imunisasi' => 'Polio 4'],
            ['nama_imunisasi' => 'IPV'],
            ['nama_imunisasi' => 'Campak'],
            ['nama_imunisasi' => 'DPTHBHIB Booster'],
            ['nama_imunisasi' => 'Campak Booster'],

            ['nama_imunisasi' => 'TT1'],
            ['nama_imunisasi' => 'TT2'],
            ['nama_imunisasi' => 'TT3'],
            ['nama_imunisasi' => 'TT4'],
            ['nama_imunisasi' => 'TT5'],
        ];

        JenisImunisasi::insert($imunisasi);
    }
}
