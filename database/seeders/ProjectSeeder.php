<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name' => 'admin',
            'redirect_to' => '/home'
        ]);

        DB::table('roles')->insert([
            'name' => 'user',
            'redirect_to' => '/home'
        ]);

        DB::table('users')->insert([
            'name' => 'Project 1',
            'email' => 'project1@project.com',
            'password' => bcrypt('password'),
            'role_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => 'Project 2',
            'email' => 'project2@project.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('keluarga_berencana')->insert([
            'nama' => 'Project 1',
            'umur' => 'Project 1',
            'type' => 'Project 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('keluarga_berencana')->insert([
            'nama' => 'Project 2',
            'umur' => 'Project 2',
            'type' => 'Project 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('imunisasi')->insert([
            'nama' => 'Project 1',
            'umur' => 'Project 1',
            'jenis_kelamin' => 'Laki-laki',
            'nama_ayah' => 'Project 1',
            'nama_ibu' => 'Project 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('imunisasi')->insert([
            'nama' => 'Project 2',
            'umur' => 'Project 2',
            'jenis_kelamin' => 'Perempuan',
            'nama_ayah' => 'Project 2',
            'nama_ibu' => 'Project 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ibu_hamil')->insert([
            'nama' => 'Project 1',
            'umur' => 'Project 1',
            'umur_kandungan' => '1 tahun',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('ibu_hamil')->insert([
            'nama' => 'Project 2',
            'umur' => 'Project 2',
            'umur_kandungan' => '2 tahun',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('penyakit')->insert([
            'nama' => 'Project 1',
            'umur' => 'Project 1',
            'jenis_kelamin' => 'Laki-laki',
            'penyakit' => 'Project 1',
            'gejala' => 'Project 1',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('penyakit')->insert([
            'nama' => 'Project 2',
            'umur' => 'Project 2',
            'jenis_kelamin' => 'Perempuan',
            'penyakit' => 'Project 2',
            'gejala' => 'Project 2',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}