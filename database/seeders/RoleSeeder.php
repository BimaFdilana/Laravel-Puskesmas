<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => 'petugas',
                'redirect_to' => '/admin'
            ],
            [
                'name' => 'pustu',
                'redirect_to' => '/home'
            ],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}