<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $statuses = [
        ["available", "available"],
        ["unavailable", "unavailable"]
    ];

    public function run(): void
    {
        foreach ($this->statuses as $status) {
            \App\Models\Status::create([
                // "guid" => $role[0],
                "status" => $status[1],
            ]);
        }
    }
}
