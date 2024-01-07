<?php

namespace App\Charts;

use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KecamatanChart_
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $umkmData = UMKM::where('status', 'proses')->get();

        // Group UMKMs by kecamatan and count them
        $kecamatanCounts = $umkmData->groupBy('kecamatan')->map->count();

        return $this->chart->barChart()
            ->setTitle('UMKM Pada Tiap Kecamatan')
            ->setSubtitle('')
            ->addData('UMKM Count', array_values($kecamatanCounts->toArray()))
            ->setXAxis(array_keys($kecamatanCounts->toArray()));
    }
}
