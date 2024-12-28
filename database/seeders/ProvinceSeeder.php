<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $provinces = [
        [1, 1, "West Java"],
        [2, 1, "East Java"],
        [3, 1, "Central Java"],
    ];

    public function run(): void
    {
        foreach ($this->provinces as $province) {
            \App\Models\Province::create([
                "id" => $province[0],
                "country" => $province[1],
                "province" => $province[2]
            ]);
        }
    }
}
