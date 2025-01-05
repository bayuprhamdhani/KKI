<?php

namespace App\Charts;

use App\Models\Transaction;
use App\Models\Company;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionsByCompanyChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $companies = Company::all(); // Ambil semua perusahaan
        $data = [];

        foreach ($companies as $company) {
            // Hitung transaksi berdasarkan perusahaan
            $data[] = Transaction::whereHas('car', function ($query) use ($company) {
                $query->where('company', $company->id);
            })->count();
        }

        if (empty($data)) {
            $data = [0];  // Nilai default jika tidak ada data
        }

        return $this->chart->barChart()
            ->setTitle('')
            ->setSubtitle('')
            ->addData('Transaction Total', $data)
            ->setXAxis($companies->pluck('name')->toArray() ?: ['No Data']);
    }
}
