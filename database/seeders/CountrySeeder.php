<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $countries = [
        [1, "Indonesia"]
    ];

    public function run(): void
    {
        foreach ($this->countries as $country) {
            \App\Models\Country::create([
                "id" => $country[0],
                "country" => $country[1],
            ]);
        }
    }
}
