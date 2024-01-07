<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
             'name' => 'admin',
             'email' => 'admin@example.com',
             'password' => '12345',
             'role' => 'admin'
        ]);

        \App\Models\User::factory()->create([
            'name' => 'admin',
            'email' => 'dinas@example.com',
            'password' => '12345',
            'role' => 'dinas'
       ]);

       \App\Models\User::factory()->create([
        'name' => 'admin',
        'email' => 'bidang@example.com',
        'password' => '12345',
        'role' => 'bidang'
   ]);

        $this->call(JenisUsahaSeeder::class);
        $this->call(KlasifikasiUsahaSeeder::class);
        $this->call(UMKMSeeder::class);
    }
}
