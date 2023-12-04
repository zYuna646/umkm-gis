<?php

namespace App\Charts;

use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class BantuanChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $umkmData = UMKM::where('status', 'terima')->get();

        $totalBantuan = $umkmData->where('is_bantuan', true)->count();
        $totalNonBantuan = $umkmData->where('is_bantuan', false)->count();

        return $this->chart->donutChart()
            ->setTitle('Bantuan Yang Telah Di Terima Dari Pemerintah')
            ->setSubtitle(' ')
            ->addData([$totalBantuan, $totalNonBantuan])
            ->setLabels(['Telah Menerima', 'Belum Menerima']);
    }
}
