<?php

namespace App\Charts;

use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class PendapatanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\BarChart
    {
        $umkm = UMKM::where('status', 'terima');

        $umkmAsetCounts = [
            '0-2 juta' => $umkm->whereBetween('pendapatan_aset', [0, 2000000])->count(),
            '2-5 juta' => $umkm->whereBetween('pendapatan_aset', [2000000, 5000000])->count(),
            '5-10 juta' => $umkm->whereBetween('pendapatan_aset', [5000000, 10000000])->count(),
            '10-20 juta' => $umkm->whereBetween('pendapatan_aset', [10000000, 20000000])->count(),
            '> 20 juta' => $umkm->where('pendapatan_aset', '>', 20000000)->count(),
        ];

        $umkmOmsetCounts = [
            '0-2 juta' => $umkm->whereBetween('pendapatan_omset', [0, 2000000])->count(),
            '2-5 juta' => $umkm->whereBetween('pendapatan_omset', [2000000, 5000000])->count(),
            '5-10 juta' => $umkm->whereBetween('pendapatan_omset', [5000000, 10000000])->count(),
            '10-20 juta' => $umkm->whereBetween('pendapatan_omset', [10000000, 20000000])->count(),
            '> 20 juta' => $umkm->where('pendapatan_omset', '>', 20000000)->count(),
        ];

        return $this->chart->barChart()
            ->setTitle('Pendapatan (Aset Dan Omset)')
            ->setSubtitle('')
            ->addData('Pendapatan Aset', array_values($umkmAsetCounts))
            ->addData('Pendapatan Omset', array_values($umkmOmsetCounts))
            ->setColors(['#3498db', '#e74c3c']) // Set colors for each bar
            ->setXAxis(array_keys($umkmAsetCounts));
    }

}
