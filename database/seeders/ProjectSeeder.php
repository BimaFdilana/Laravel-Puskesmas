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

    }
}