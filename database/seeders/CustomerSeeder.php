<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */          
    private $customers = [
        ["Trinanda Zalsa", "trinanda@gmail.com", "123456", "081312424171", 1, 1, 1, 5, 1, "839271", "2024-02-10", "6734"],
        ["Rainna Shofa", "rainna@gmail.com", "123456", "081829361839", 1, 1, 2, 4, 2, "678236", "2024-12-01", "1323"],
        ["Esa Albi", "esa@gmail.com", "123456", "081748392016", 1, 2, 3, 3, 3, "839271", "2024-11-09", "7105"],
        ["Naufal Elqolbi", "naufal@gmail.com", "123456", "081739402648", 1, 2, 4, 2, 1, "839271", "2023-01-12", "1035"],
        ["Fikri Ardian", "fikri@gmail.com", "123456", "081291035489", 1, 3, 5, 1, 2, "839271", "2024-04-07", "9275"],
    ];

    public function run(): void
    {
        foreach ($this->customers as $customer) {
            \App\Models\Customer::create([
                "name" => $customer[0],
                "email" => $customer[1],
                "password" => $customer[2],
                "contact" => $customer[3],
                "country" => $customer[4],
                "province" => $customer[5],
                "city" => $customer[6],
                "subdistrict" => $customer[7],
                "card_type" => $customer[8],
                "card_number" => $customer[9],
                "card_expired" => $customer[10],
                "cvv" => $customer[11],
            ]);
        }
    }
}
