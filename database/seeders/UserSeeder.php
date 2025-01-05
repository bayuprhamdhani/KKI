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
        ["1", "assa@gmail.com", "123456", 2, "company-logo/assa.png"],
        ["2", "autonet@gmail.com", "123456", 2, "company-logo/autonet.jpg"],
        ["3", "budiman@gmail.com", "123456", 2, "company-logo/budiman.png"],
        ["4", "doaibu@gmail.com", "123456", 2, "company-logo/doa ibu.jpg"],
        ["5", "monas@gmail.com", "123456", 2, "company-logo/monas.jpg"],
        ["1", "trinanda@gmail.com", "123456", 3, ""],
        ["2", "raina@gmail.com", "123456", 3, ""],
        ["3", "esa@gmail.com", "123456", 3, ""],
        ["4", "naufal@gmail.com", "123456", 3, ""],
        ["5", "fikri@gmail.com", "123456", 3, ""]
    ];

    public function run(): void
    {
        foreach ($this->users as $user) {
            \App\Models\User::create([
                "user" => $user[0],
                "email" => $user[1],
                "password" => $user[2],
                "role_id" => $user[3],
                "path" => $user[4]
            ]);
        }
    }
}
