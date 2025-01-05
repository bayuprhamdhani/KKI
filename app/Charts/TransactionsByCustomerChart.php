<?php

namespace App\Charts;

use App\Models\Transaction;
use App\Models\Customer;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TransactionsByCustomerChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $cars = Customer::all();
        $data = [];

        foreach ($cars as $car) {
            $data[] = Transaction::where('customer', $car->id)->count();
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
