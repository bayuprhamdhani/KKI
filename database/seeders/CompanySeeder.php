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
        ["Assa", "assa@gmail.com", "123456", 1, 1, 1, 1, 1, "company-logo/1.png", 1, "1423243234","81312424171"],
        ["Autonet", "autonet@gmail.com", "123456", 1, 1, 2, 6, 1, "company-logo/2.jpg", 2, "1423243234","85895160144"],
        ["Budiman", "budiman@gmail.com", "123456", 1, 2, 6, 26, 1, "company-logo/3.png", 3, "1423243234","85895160144"],
        ["Doa Ibu", "doaibu@gmail.com", "123456", 1, 2, 7, 31, 1, "company-logo/4.jpg", 1, "1423243234","81312424171"],
        ["Monas", "monas@gmail.com", "123456", 1, 3, 11, 51, 2, "company-logo/5.jpg", 2, "1423243234","85895160144"]
    ];

    public function run(): void
    {
        foreach ($this->companies as $company) {
            \App\Models\Company::create([
                "name" => $company[0],
                "email" => $company[1],
                "password" => $company[2],
                "country" => $company[3],
                "province" => $company[4],
                "city" => $company[5],
                "subdistrict" => $company[6],
                "status" => $company[7],
                "logo" => $company[8],
                "bank" => $company[9],
                "norek" => $company[10],
                "contact" => $company[11]
            ]);
        }
    }
}
