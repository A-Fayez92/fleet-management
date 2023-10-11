<?php

namespace Database\Seeders;

use App\Models\Station;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Station::insert([
            ['name' => 'Cairo', 'slug' => 'cairo'],
            ['name' => 'Giza', 'slug' => 'giza'],
            ['name' => 'Qalyubia', 'slug' => 'qalyubia'],
            ['name' => 'Alexandria', 'slug' => 'alexandria'],
            ['name' => 'Beheira', 'slug' => 'beheira'],
            ['name' => 'Matrouh', 'slug' => 'matrouh'],
            ['name' => 'Damietta', 'slug' => 'damietta'],
            ['name' => 'Port Said', 'slug' => 'port-said'],
            ['name' => 'Ismailia', 'slug' => 'ismailia'],
            ['name' => 'Suez', 'slug' => 'suez'],
            ['name' => 'Sharqia', 'slug' => 'sharqia'],
            ['name' => 'Port Said', 'slug' => 'port-said'],
            ['name' => 'Daqahlia', 'slug' => 'daqahlia'],
            ['name' => 'Kafr El Sheikh', 'slug' => 'kafr-el-sheikh'],
            ['name' => 'Gharbia', 'slug' => 'gharbia'],
            ['name' => 'Monufia', 'slug' => 'monufia'],
            ['name' => 'Beheira', 'slug' => 'beheira'],
            ['name' => 'Sharqia', 'slug' => 'sharqia'],
            ['name' => 'Fayoum', 'slug' => 'fayoum'],
            ['name' => 'Beni Suef', 'slug' => 'beni-suef'],
            ['name' => 'Minya', 'slug' => 'minya'],
            ['name' => 'Asyut', 'slug' => 'asyut'],
            ['name' => 'Sohag', 'slug' => 'sohag'],
            ['name' => 'Qena', 'slug' => 'qena'],
            ['name' => 'Luxor', 'slug' => 'luxor'],
            ['name' => 'Aswan', 'slug' => 'aswan'],
            ['name' => 'New Valley', 'slug' => 'new-valley'],
            ['name' => 'Matrouh', 'slug' => 'matrouh'],
            ['name' => 'North Sinai', 'slug' => 'north-sinai'],
            ['name' => 'South Sinai', 'slug' => 'south-sinai'],
            ['name' => 'Red Sea', 'slug' => 'red-sea'],
        ]);
    }
}
