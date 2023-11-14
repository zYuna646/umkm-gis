<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KlasifikasiUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $data = [
            ['name' => 'Menengah', 'slug' => 'Menengah'],
            ['name' => 'Kecil', 'slug' => 'Kecil'],
            ['name' => 'Mikro', 'slug' => 'Mikro'],
        ];

        DB::table('klasifikasi_usahas')->insert($data);
    }
}
