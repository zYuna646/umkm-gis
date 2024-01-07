<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UMKMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // You can adjust the number of records you want to seed
        $numberOfRecords = 100;

        $statuses = ['proses', 'terima', 'tolak'];
        $kecamatanList = ['Bilalang', 'Bolang', 'Bolaang Timur', 'Dumoga']; // Add your kecamatan names here

        for ($i = 0; $i < $numberOfRecords; $i++) {
            $jenisUsahaId = \App\Models\JenisUsaha::inRandomOrder()->first()->id;
            $klasifikasiUsahaId = \App\Models\KlasifikasiUsaha::inRandomOrder()->first()->id;

            // Generate random coordinates within a small range around the central point
            $latitude = 0.556174 + (rand(-100, 100) / 1000);  // Random offset within 0.1 degrees
            $longitude = 123.058548 + (rand(-100, 100) / 1000); // Random offset within 0.1 degrees

            DB::table('u_m_k_m_s')->insert([
                'is_Aktif' => rand(0, 1) == 1 ? true : false,
                'is_Umum' => rand(0, 1) == 1 ? true : false,
                'is_Bantuan' => rand(0, 1) == 1 ? true : false,
                'nama_pemilik' => 'Pemilik ' . ($i + 1),
                'alamat' => 'Alamat ' . ($i + 1),
                'desa' => 'Desa ' . ($i + 1),
                'foto' => '',
                'link' => 'link' . ($i + 1),
                'kecamatan' => $kecamatanList[array_rand($kecamatanList)], // Random kecamatan from the list
                'kabupaten' => 'Bolaang Mongondow',
                'pendapatan_aset' => rand(10000, 50000),
                'pendapatan_omset' => rand(5000, 30000),
                'tenaga_kerja_l' => rand(5, 20),
                'tenaga_kerja_p' => rand(5, 20),
                'jumlah_tenaga_kerja' => rand(10, 40),
                'keterangan_jenis_usaha' => 'Keterangan Jenis Usaha ' . ($i + 1),
                'keterangan' => 'Keterangan ' . ($i + 1),
                'status' => $statuses[array_rand($statuses)],
                'message' => '',
                'kordinat' => DB::raw("(POINT($latitude, $longitude))"),
                'jenis_usaha_id' => $jenisUsahaId,
                'klasifikasi_usaha_id' => $klasifikasiUsahaId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
