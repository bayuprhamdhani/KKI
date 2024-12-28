<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $card_types = [
        ["Visa"],
        ["Master Card"],
        ["American Express"]
    ];

    public function run(): void
    {
        foreach ($this->card_types as $card_type) {
            \App\Models\CardType::create([
                // "guid" => $role[0],
                "card_type" => $card_type[0],
            ]);
        }
    }
}
