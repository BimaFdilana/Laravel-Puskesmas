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
            'name' => 'petugas',
            'redirect_to' => '/home',
        ]);

        DB::table('roles')->insert([
            'name' => 'pustu',
            'redirect_to' => '/home',
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
    }
}
