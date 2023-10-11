<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bus::insert([
            ['name' => 'CAI-05', 'seats' => 12],
            ['name' => 'CAI-06', 'seats' => 12],
            ['name' => 'CAI-07', 'seats' => 12],
            ['name' => 'CAI-08', 'seats' => 12],
            ['name' => 'CAI-09', 'seats' => 12],
            ['name' => 'CAI-10', 'seats' => 12],
        ]);
    }
}
