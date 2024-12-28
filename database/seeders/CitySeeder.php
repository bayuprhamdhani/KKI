<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $cities = [
        [1,1, "Tasikmalaya"], [2,1, "Bandung"], [3,1, "Banjar"], [4,1, "Bogor"], [5,1, "Bekasi"],
        [6, 2, "Surabaya"], [7, 2, "Malang"], [8, 2, "Pasuruan"], [9, 2, "Blitar"], [10, 2, "Madiun"],
        [11, 3, "Semarang"], [12, 3, "Tegal"], [13, 3, "Surakarta"], [14, 3, "Magelang"], [15, 3, "Cilacap"]
    ];

    public function run(): void
    {
        foreach ($this->cities as $city) {
            \App\Models\City::create([
                "id" => $city[0],
                "province" => $city[1],
                "city" => $city[2]
            ]);
        }
    }
}
