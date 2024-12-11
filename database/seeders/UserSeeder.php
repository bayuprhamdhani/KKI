<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */          
    private $users = [
        ["Bayu", "bayuraina@gmail.com", "123456", 1, ""],
        ["Nika Rent", "nika@gmail.com", "123456", 2, "company-logo/test.jpeg"],
        ["Zalsa Rent", "zalsa@gmail.com", "123456", 2, "company-logo/test.jpeg"],
        ["trinanda", "trinanda@gmail.com", "123456", 3, ""],
    ];

    public function run(): void
    {
        foreach ($this->users as $user) {
            \App\Models\User::create([
                "name" => $user[0],
                "email" => $user[1],
                "password" => $user[2],
                "role_id" => $user[3],
                "path" => $user[4]
            ]);
        }
    }
}
