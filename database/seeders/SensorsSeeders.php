<?php

namespace Database\Seeders;
use App\Models\Sensor;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SensorsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        // DB::table('sensors')->insert([
        //     'id_sensor' => 1,
        //     'id_greenhouse' => '1',
        //     'suhu_data' => '22',
        //     'kelem_data' => '12',
        //     'cahaya_data' => '44',
        //     'ketinggian_data' => '16',
        //     'ph_data' => '8',
        //     'tds_data' => '33',
        //     'created_at' => now(),
        //     'updated_at' => now()
            
        // ]);

        Sensor::firstOrCreate([
            'id_sensor' => 1,
            'id_greenhouse' => '1',
            'suhu_data' => '22',
            'kelem_data' => '12',
            'cahaya_data' => '44',
            'ketinggian_data' => '16',
            'ph_data' => '8',
            'tds_data' => '33',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        Sensor::firstOrCreate([
            'id_sensor' => 2,
            'id_greenhouse' => '1',
            'suhu_data' => '32',
            'kelem_data' => '32',
            'cahaya_data' => '54',
            'ketinggian_data' => '36',
            'ph_data' => '5',
            'tds_data' => '77',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
    }
}
