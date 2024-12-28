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
        ["ALPHARD", 6, 1, 750000, "car-pict/alphard.jpg", 1, "company-logo/assa.png", "Assa"],
        ["AVANZA", 6, 1, 600000, "car-pict/avanza.jpg", 1, "company-logo/assa.png", "Assa"],
        ["BMW", 4, 1, 850000, "car-pict/bmw.jpg", 1, "company-logo/assa.png", "Assa"],
        ["BRIO", 4, 1, 450000, "car-pict/brio.jpg", 1, "company-logo/autonet.jpg", "Autonet"],
        ["BYD", 4, 1, 350000, "car-pict/byd.jpg", 1, "company-logo/autonet.jpg", "Autonet"],
        ["CIVIC", 4, 1, 750000, "car-pict/civic.jpg", 1, "company-logo/autonet.jpg", "Autonet"],
        ["DAIHATSU", 4, 1, 650000, "car-pict/daihatsu.jpg", 1, "company-logo/budiman.png", "Budiman"],
        ["FERARI", 4, 1, 950000, "car-pict/ferari.jpg", 1, "company-logo/budiman.png", "Budiman"],
        ["FORTUNER", 6, 2, 700000, "car-pict/fortuner.jpg", 1, "company-logo/budiman.png", "Budiman"],
        ["JAZZ", 6, 2, 400000, "car-pict/jazz.jpg", 1, "company-logo/doa ibu.jpg", "Doa Ibu"],
        ["JEEP", 6, 2, 500000, "car-pict/jeep.jpg", 1, "company-logo/doa ibu.jpg", "Doa Ibu"],
        ["LAMBORGHINI", 6, 2, 950000, "car-pict/lamborghini.jpg", 1, "company-logo/doa ibu.jpg", "Doa Ibu"],
        ["MAZDA", 6, 2, 500000, "car-pict/mazda.jpg", 1, "company-logo/monas.jpg", "Monas"],
        ["TOYOTA", 6, 1, 450000, "car-pict/toyota.jpg", 1, "company-logo/monas.jpg", "Monas"],
        ["WULING", 4, 2, 700000, "car-pict/wuling.jpg", 1, "company-logo/monas.jpg", "Monas"]
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
