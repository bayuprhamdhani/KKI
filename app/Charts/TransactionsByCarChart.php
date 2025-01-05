<?php

namespace App\Charts;

use App\Models\Transaction;
use App\Models\Car;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionsByCarChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
{
    // Inisialisasi variabel cars
    $cars = collect(); 

    // Cek apakah pengguna sudah login
    if (auth()->check()) {
        if (auth()->user()->role_id == 1) {
            // Jika role_id = 1, ambil semua data dari tabel cars
            $cars = Car::all();
        } else {
            // Jika role_id = 2, ambil data hanya yang company-nya sama dengan user yang login
            $cars = Car::where('company', auth()->user()->user)->get();
        }
    }

    $data = [];

    foreach ($cars as $car) {
        $data[] = Transaction::where('car', $car->id)->count();
    }

    if (empty($data)) {
        $data = [0];  // Default value to ensure chart renders
    }

    return $this->chart->barChart()
        ->setTitle('')
        ->setSubtitle('')
        ->addData('Transaction Total', $data)
        ->setXAxis($cars->pluck('name')->toArray() ?: ['No Data']);
}

    
}
