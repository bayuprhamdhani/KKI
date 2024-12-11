<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */          
    private $cars = [
        ["BMW", 4, 1, "Rp 850.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Nika Rent"],
        ["MAZDA", 4, 2, "Rp 300.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Nika Rent"],
        ["TOYOTA", 6, 1, "Rp 450.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Nika Rent"],
        ["AVANZA", 6, 1, "Rp 600.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Nika Rent"],
        ["KIJANG", 8, 2, "Rp 500.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Zalsa Rent"],
        ["ALPHARD", 6, 1, "Rp 750.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Zalsa Rent"],
        ["FORTUNER", 6, 2, "Rp 700.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Zalsa Rent"],
        ["CIVIC", 4, 1, "Rp 650.000", "car-pict/test.jpeg", 1, "company-logo/test.jpeg", "Zalsa Rent"],
    ];

    public function run(): void
    {
        foreach ($this->cars as $car) {
            \App\Models\Car::create([
                "name" => $car[0],
                "qty" => $car[1],
                "transmisi" => $car[2],
                "price" => $car[3],
                "pict" => $car[4],
                "status" => $car[5],
                "company_logo" => $car[6],
                "company_name" => $car[7],
            ]);
        }
    }
}
