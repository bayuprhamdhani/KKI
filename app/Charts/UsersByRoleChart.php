<?php

namespace App\Charts;

use App\Models\Selling;
use App\Models\User;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class UsersByRoleChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $cashier = User::where('role_id', 6);
        $data = [];

        foreach ($cashier->get() as $key => $user) {
            $data[$key] = Selling::where('cashier_id', $user->id)->count();
        }

        return $this->chart->barChart()
            ->setTitle('Total Penjualan By Cashier.')
            ->setSubtitle('Seluruh penjualan dibedakan berdasarkan kasir.')
            ->addData('Total Penjualan', $data)
            ->setXAxis($cashier->pluck('name')->toArray());
    }
}
