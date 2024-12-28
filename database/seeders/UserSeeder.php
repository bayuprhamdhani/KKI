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
        ["Assa", "assa@gmail.com", "123456", 2, "company-logo/assa.png"],
        ["Autonet", "autonet@gmail.com", "123456", 2, "company-logo/autonet.jpg"],
        ["Budiman", "budiman@gmail.com", "123456", 2, "company-logo/budiman.png"],
        ["Doa Ibu", "doaibu@gmail.com", "123456", 2, "company-logo/doa ibu.jpg"],
        ["Trinanda Zalsa", "trinanda@gmail.com", "123456", 3, ""],
        ["Rainna Shofa", "raina@gmail.com", "123456", 3, ""],
        ["Esa Albi", "esa@gmail.com", "123456", 3, ""],
        ["Naufal Elqolbi", "naufal@gmail.com", "123456", 3, ""],
        ["Fikri Ardian", "fikri@gmail.com", "123456", 3, ""]
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
