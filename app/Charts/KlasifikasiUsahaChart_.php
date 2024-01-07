<?php

namespace App\Charts;

use App\Models\KlasifikasiUsaha;
use App\Models\UMKM;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class KlasifikasiUsahaChart_
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $umkmData = UMKM::where('status', 'proses')->get();

        // Assuming that 'jenis_usaha_id' is the foreign key representing the type of business in UMKM model
        $jenisUsahaCounts = $umkmData->groupBy('klasifikasi_usaha_id')->map->count();

        // Retrieve business type names from the related JenisUsaha model
        $jenisUsahaNames = KlasifikasiUsaha::whereIn('id', array_keys($jenisUsahaCounts->toArray()))->pluck('name');

        return $this->chart->pieChart()
            ->setTitle('UMKM Berdasarkan Klasifikasi Usaha')
            ->setSubtitle(' ')
            ->addData(array_values($jenisUsahaCounts->toArray()))
            ->setLabels($jenisUsahaNames->toArray());
    }
}
