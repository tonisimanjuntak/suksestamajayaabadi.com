<?php

namespace Database\Seeders;

use App\Models\Konsumen;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Konsumen::factory()->count(50)->create(); // Membuat 50 user dummy
    }
}
