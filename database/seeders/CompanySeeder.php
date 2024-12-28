<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $companies = [
        ["Assa", "assa@gmail.com", "123456", "tasikmalaya", 1, "company-logo/assa.png", "BCA", "1423243234"],
        ["Autonet", "autonet@gmail.com", "123456", "bandung", 1, "company-logo/autonet.jpg", "BRI", "1423243234"],
        ["Budiman", "TEST3@gmail.com", "123456", "garut", 2, "company-logo/budiman.png", "Mandiri", "1423243234"],
        ["Doa Ibu", "doaibu@gmail.com", "123456", "ciamis", 1, "company-logo/doa ibu.jpg", "BSI", "1423243234"],
        ["Monas", "monas@gmail.com", "123456", "majalengka", 2, "company-logo/monas.jpg", "BCA", "1423243234"]
    ];

    public function run(): void
    {
        foreach ($this->companies as $company) {
            \App\Models\Company::create([
                "name" => $company[0],
                "email" => $company[1],
                "password" => $company[2],
                "address" => $company[3],
                "status" => $company[4],
                "logo" => $company[5],
                "bank" => $company[6],
                "norek" => $company[7],
            ]);
        }
    }
}
