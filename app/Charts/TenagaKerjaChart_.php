<?php

namespace App\Charts;

use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class TenagaKerjaChart_
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\DonutChart
    {
        $umkmData = UMKM::where('status', 'proses')->get();

        $totalTenagaKerjaL = $umkmData->sum('tenaga_kerja_l');
        $totalTenagaKerjaP = $umkmData->sum('tenaga_kerja_p');

        return $this->chart->donutChart()
            ->setTitle('Jumlah Tenaga Kerja')
            ->setSubtitle(' ')
            ->addData([$totalTenagaKerjaL, $totalTenagaKerjaP])
            ->setLabels(['Tenaga Kerja Laki-Laki', 'Tenaga Kerja Perempuan']);
    }
}
