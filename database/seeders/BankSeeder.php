<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $banks = [
        ["BRI"],
        ["BCA"],
        ["BNI"]
    ];

    public function run(): void
    {
        foreach ($this->banks as $bank) {
            \App\Models\Bank::create([
                // "guid" => $role[0],
                "bank" => $bank[0],
            ]);
        }
    }
}
