<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $roles = [
        ["admin"],
        ["company"],
        ["customer"],
    ];

    public function run(): void
    {
        foreach ($this->roles as $role) {
            \App\Models\Role::create([
                // "guid" => $role[0],
                "role_name" => $role[0],
            ]);
        }
    }
}
