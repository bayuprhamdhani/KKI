<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubdistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $subdistricts = [
        [1, "Bungursari"],
        [2, "Cibeureum"],
        [3, "Cihideung"],
        [4, "Cipedes"],
        [5, "Indihiang"],
        [6, "Kawalu"],
        [7, "Mangkubumi"],
        [8, "Purbaratu"],
        [9, "Tamansari"],
        [10, "Tawang"],
    ];

    public function run(): void
    {
        foreach ($this->subdistricts as $subdistrict) {
            \App\Models\Subdistrict::create([
                "id" => $subdistrict[0],
                "subdistrict_name" => $subdistrict[1],
            ]);
        }
    }
}
