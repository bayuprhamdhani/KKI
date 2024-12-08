<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransmisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $transmisies = [
        ["Manual"],
        ["Matic"]
    ];

    public function run(): void
    {
        foreach ($this->transmisies as $transmisi) {
            \App\Models\Transmisi::create([
                // "guid" => $role[0],
                "transmisi" => $transmisi[0],
            ]);
        }
    }
}
