<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $charts = [
        [1, "Car"],
        [2, "Month"],
        [3, "Company"],
        [4, "Customer"]
    ];

    public function run(): void
    {
        foreach ($this->charts as $chart) {
            \App\Models\Chart::create([
                "id" => $chart[0],
                "chart" => $chart[1],
            ]);
        }
    }
}
