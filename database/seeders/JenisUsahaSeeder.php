<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisUsahaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
           $data = [
            ['name' => 'Perkebunan', 'slug' => 'Perkebunan'],
            ['name' => 'Jasa', 'slug' => 'Jasa'],
            ['name' => 'Pertanian', 'slug' => 'Pertanian'],
            ['name' => 'Perdagangan', 'slug' => 'Perdagangan'],
            ['name' => 'Kerajinan', 'slug' => 'Kerajinan'],
            ['name' => 'Perikanan', 'slug' => 'Perikanan'],
        ];

        DB::table('jenis_usahas')->insert($data);
    }
}
