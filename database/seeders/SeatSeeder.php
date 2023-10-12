<?php

namespace Database\Seeders;

use App\Models\Bus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $buses = Bus::all();

        foreach ($buses as $bus) {
            $bus->BusSeats()->createMany([
                ['number' => 1],
                ['number' => 2],
                ['number' => 3],
                ['number' => 4],
                ['number' => 5],
                ['number' => 6],
                ['number' => 7],
                ['number' => 8],
                ['number' => 9],
                ['number' => 10],
                ['number' => 11],
                ['number' => 12],
            ]);
        }
    }
}
