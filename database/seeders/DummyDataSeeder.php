<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Posyandu;
use App\Models\Penyakit;
use App\Models\JenisImunisasi;
use App\Models\ImunisasiBayi;
use App\Models\ImunisasiWusBumil;
use App\Models\PesertaKbBaru;
use App\Models\SurveilansPenyakit;
use App\Models\AncRecord;

class DummyDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan factory untuk data palsu
        $faker = \Faker\Factory::create('id_ID'); // Menggunakan data regional Indonesia

        // 1. Matikan pengecekan foreign key untuk truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // 2. Kosongkan semua tabel terkait
        User::truncate();
        Posyandu::truncate();
        ImunisasiBayi::truncate();
        ImunisasiWusBumil::truncate();
        PesertaKbBaru::truncate();
        SurveilansPenyakit::truncate();
        AncRecord::truncate();

        // 3. Buat Akun Admin Utama (role 1)
        $admin = User::create([
            'name' => 'Admin Puskesmas',
            'email' => 'admin@puskesmas.com',
            'password' => Hash::make('password'),
            'role_id' => 1,
        ]);

        // 4. Buat 3 Akun Pustu (role 2)
        $pustuUsers = collect();
        $pustuNames = ['Pustu Rumbai', 'Pustu Sebauk', 'Pustu Mangga'];
        foreach ($pustuNames as $name) {
            $pustuUsers->push(User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '', $name)) . '@pustu.com',
                'password' => Hash::make('password'),
                'role_id' => 2,
            ]));
        }

        // Ambil ID dari master data yang sudah ada (pastikan PenyakitSeeder & JenisImunisasiSeeder sudah jalan)
        $penyakitIds = Penyakit::pluck('id');
        $imunisasiBayiIds = JenisImunisasi::whereNotIn('nama_imunisasi', ['TT1', 'TT2', 'TT3', 'TT4', 'TT5'])->pluck('id');
        $imunisasiBumilIds = JenisImunisasi::whereIn('nama_imunisasi', ['TT1', 'TT2', 'TT3', 'TT4', 'TT5'])->pluck('id');

        // 5. Loop setiap Pustu untuk membuat data terkait
        $pustuUsers->each(function ($pustu) use ($faker, $penyakitIds, $imunisasiBayiIds, $imunisasiBumilIds) {

            // Buat 2 Posyandu untuk setiap Pustu
            $posyandus = collect();
            for ($i = 0; $i < 2; $i++) {
                $posyandus->push(Posyandu::create([
                    'nama_posyandu' => 'Posyandu ' . $faker->words(2, true),
                    'user_id' => $pustu->id,
                ]));
            }
            $posyanduIds = $posyandus->pluck('id');

            // Buat 5-10 data dummy untuk setiap modul per Pustu
            for ($j = 0; $j < $faker->numberBetween(5, 10); $j++) {

                // Data Imunisasi Bayi
                ImunisasiBayi::create([
                    'user_id' => $pustu->id,
                    'posyandu_id' => $faker->randomElement($posyanduIds),
                    'nama_bayi' => $faker->name('female'),
                    'nama_orang_tua' => $faker->name('male'),
                    'tanggal_lahir' => $faker->dateTimeBetween('-2 years', '-1 month'),
                    'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                    'alamat_lengkap' => $faker->address,
                    'jenis_imunisasi_id' => $faker->randomElement($imunisasiBayiIds),
                ]);

                // Data Imunisasi WUS & Bumil
                ImunisasiWusBumil::create([
                    'user_id' => $pustu->id,
                    'posyandu_id' => $faker->randomElement($posyanduIds),
                    'nama_wus_bumil' => $faker->name('female'),
                    'nama_suami' => $faker->name('male'),
                    'umur' => $faker->numberBetween(20, 40),
                    'hamil_ke' => $faker->randomElement([0, 1, 2, 3]), // 0 untuk WUS
                    'alamat_lengkap' => $faker->address,
                    'jenis_imunisasi_id' => $faker->randomElement($imunisasiBumilIds),
                ]);

                // Data Peserta KB Baru
                PesertaKbBaru::create([
                    'user_id' => $pustu->id,
                    'posyandu_id' => $faker->randomElement($posyanduIds),
                    'nama_pasien' => $faker->name('female'),
                    'tanggal_pelayanan' => $faker->dateTimeBetween('-1 year', 'now'),
                    'jenis_kontrasepsi' => $faker->randomElement(['PIL', 'SUNTIK', 'KONDOM', 'IUD', 'IMPLAN', 'MOW', 'MOP']),
                    'jalur_layanan' => $faker->randomElement(['UMUM', 'BPJS/K', 'PASCA SALIN']),
                ]);

                // Data Surveilans Penyakit
                if ($penyakitIds->isNotEmpty()) {
                    SurveilansPenyakit::create([
                        'user_id' => $pustu->id,
                        'penyakit_id' => $faker->randomElement($penyakitIds),
                        'nama_pasien' => $faker->name(),
                        'tanggal_lahir' => $faker->dateTimeBetween('-80 years', '-1 day'),
                        'jenis_kelamin' => $faker->randomElement(['L', 'P']),
                        'tanggal_kunjungan' => $faker->dateTimeBetween('-1 year', 'now'),
                    ]);
                }

                // Data ANC
                AncRecord::create([
                    'user_id' => $pustu->id,
                    'rekam_medis' => 'RM-' . $faker->unique()->numerify('######'),
                    'kohort' => 'KH-' . $faker->unique()->numerify('######'),
                    'nama_pasien' => $faker->name('female'),
                    'alamat' => $faker->address,
                    'nik' => $faker->numerify('################'),
                    'petugas' => $pustu->name,
                    'k1' => json_encode($faker->randomElements(array_keys(AncRecord::getAncItems()), $faker->numberBetween(3, 10))),
                    'k2' => json_encode($faker->randomElements(array_keys(AncRecord::getAncItems()), $faker->numberBetween(3, 10))),
                ]);
            }
        });

        // 6. Hidupkan kembali pengecekan foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
