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
        ["BMW", 4, 1, "Rp 850.000", "car-pict/test.jpeg", 1],
        ["MAZDA", 4, 2, "Rp 300.000", "car-pict/test.jpeg", 1],
        ["TOYOTA", 6, 1, "Rp 450.000", "car-pict/test.jpeg", 1],
        ["AVANZA", 6, 1, "Rp 600.000", "car-pict/test.jpeg", 1],
        ["KIJANG", 8, 2, "Rp 500.000", "car-pict/test.jpeg", 1],
        ["ALPHARD", 6, 1, "Rp 750.000", "car-pict/test.jpeg", 1],
        ["FORTUNER", 6, 2, "Rp 700.000", "car-pict/test.jpeg", 1],
        ["CIVIC", 4, 1, "Rp 650.000", "car-pict/test.jpeg", 1],
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
                "status" => $car[5]
            ]);
        }
    }
}
