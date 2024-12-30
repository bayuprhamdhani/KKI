<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */          
    private $transactions = [
        [1, 3, "2025-01-07", "2025-01-17", "2024-12-01", 8500000],
        [2, 6, "2024-12-30", "2025-01-09", "2024-12-17", 7500000],
        [3, 9, "2025-01-03", "2025-01-13", "2024-12-20", 7000000],
        [4, 12, "2024-12-25", "2025-01-04", "2024-12-07", 9500000],
        [5, 15, "2025-01-25", "2024-01-27", "2024-01-10", 2100000],
    ];

    public function run(): void
    {
        foreach ($this->transactions as $transaction) {
            \App\Models\Transaction::create([
                "customer" => $transaction[0],
                "car" => $transaction[1],
                "pick_up" => $transaction[2],
                "drop_off" => $transaction[3],
                "date_order" => $transaction[4],
                "price" => $transaction[5]
            ]);
        }
    }
}