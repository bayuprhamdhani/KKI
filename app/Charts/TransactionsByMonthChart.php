<?php

namespace App\Charts;

use App\Models\Transaction;
use App\Models\Car;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use Carbon\Carbon;

class TransactionsByMonthChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
{
    // Inisialisasi variabel transaksi sebagai koleksi kosong
    $monthlyTransactions = collect();

    // Cek apakah pengguna sudah login
    if (auth()->check()) {
        if (auth()->user()->role_id == 1) {
            // Jika role_id = 1, ambil semua transaksi
            $monthlyTransactions = Transaction::selectRaw('MONTH(date_order) as month, COUNT(*) as count')
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        } else {
            // Jika role_id = 2, ambil transaksi sesuai dengan company pengguna yang login
            $monthlyTransactions = Transaction::selectRaw('MONTH(date_order) as month, COUNT(*) as count')
                ->whereHas('car', function ($query) {
                    $query->where('company', auth()->user()->user);
                })
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }
    }

    $months = [];
    $monthlyData = [];

    foreach ($monthlyTransactions as $transaction) {
        $months[] = Carbon::create()->month($transaction->month)->format('F');
        $monthlyData[] = $transaction->count;
    }

    if (empty($monthlyData)) {
        $monthlyData = [0];
        $months = ['No Data'];
    }

    return $this->chart->barChart()
        ->setTitle('')
        ->setSubtitle('')
        ->addData('Transactions', $monthlyData)
        ->setXAxis($months);
}

    
}
