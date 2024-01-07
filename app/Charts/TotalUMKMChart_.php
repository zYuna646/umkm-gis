<?php

namespace App\Charts;

use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TotalUMKMChart_
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\LineChart
    {
        $umkmData = UMKM::where('status', 'proses')
            ->selectRaw('COUNT(id) as total_umkm, DATE(created_at) as date')
            ->groupBy('date')
            ->get();

        $totalUMKM = [];
        $dates = [];

        foreach ($umkmData as $data) {
            $totalUMKM[] = $data->total_umkm;
            $dates[] = date('Y-m-d', strtotime($data->date));
        }

        return $this->chart->lineChart()
            ->setTitle('Total UMKM')
            ->setSubtitle('')
            ->addData('Total UMKM', $totalUMKM)
            ->setXAxis($dates);
    }
}
