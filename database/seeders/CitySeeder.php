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
        [1, "Tasikmalaya"],
        [2, "Bandung"],
        [3, "Jakarta"],
        [4, "Depok"],
        [5, "Bekasi"],
    ];

    public function run(): void
    {
        foreach ($this->cities as $city) {
            \App\Models\City::create([
                "id" => $city[0],
                "city_name" => $city[1],
            ]);
        }
    }
}
