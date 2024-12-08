<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $services = [
        [1, "Rent"],
        [2, "Tour"],
        [3, "Daily Route"],
        [4, "Delivery"],
        [5, "Other"],
    ];

    public function run(): void
    {
        foreach ($this->services as $service) {
            \App\Models\Service::create([
                "id" => $service[0],
                "service_name" => $service[1],
            ]);
        }
    }
}
