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
        ["ALPHARD", 6, 1, 750000, "car-pict/1.jpg", 1, 1],
        ["AVANZA", 6, 1, 600000, "car-pict/2.jpg", 1, 1],
        ["BMW", 4, 1, 850000, "car-pict/3.jpg", 1, 1],
        ["BRIO", 4, 1, 450000, "car-pict/4.jpg", 1, 2],
        ["BYD", 4, 1, 350000, "car-pict/5.jpg", 1, 2],
        ["CIVIC", 4, 1, 750000, "car-pict/6.jpg", 1, 2],
        ["DAIHATSU", 4, 1, 650000, "car-pict/7.jpg", 1, 3],
        ["FERARI", 4, 1, 950000, "car-pict/8.jpg", 1, 3],
        ["FORTUNER", 6, 2, 700000, "car-pict/9.jpg", 1, 3],
        ["JAZZ", 6, 2, 400000, "car-pict/10.jpg", 1, 4],
        ["JEEP", 6, 2, 500000, "car-pict/11.jpg", 1, 4],
        ["LAMBORGHINI", 6, 2, 950000, "car-pict/12.jpg", 1, 4],
        ["MAZDA", 6, 2, 500000, "car-pict/13.jpg", 1, 5],
        ["TOYOTA", 6, 1, 450000, "car-pict/14.jpg", 1, 5],
        ["WULING", 4, 2, 700000, "car-pict/15.jpg", 1, 5]
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
                "company" => $car[6]
            ]);
        }
    }
}
