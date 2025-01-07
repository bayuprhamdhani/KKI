<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private $payments = [
        ["COD"],
        ["Transfer"]
    ];

    public function run(): void
    {
        foreach ($this->payments as $payment) {
            \App\Models\Payment::create([
                // "guid" => $role[0],
                "payment" => $payment[0],
            ]);
        }
    }
}
