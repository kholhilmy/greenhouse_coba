<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ReferensiJenisTanaman;

class ReferensiJenisTanamanSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'nama_jenis_ref' => 'Selada',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 560,
                'tmin_tds_ref' => 560,
                't_suhu_ref' => 20,
                't_kelembapan_ref' => 50,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '65 hari',
            ],
            [
                'nama_jenis_ref' => 'Bayam',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1260,
                'tmin_tds_ref' => 1260,
                't_suhu_ref' => 27,
                't_kelembapan_ref' => 70,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '42 hari',
            ],
            [
                'nama_jenis_ref' => 'Sawi',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 840,
                'tmin_tds_ref' => 840,
                't_suhu_ref' => 30,
                't_kelembapan_ref' => 70,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '35 hari',
            ],
            [
                'nama_jenis_ref' => 'Kangkung',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1260,
                'tmin_tds_ref' => 1260,
                't_suhu_ref' => 30,
                't_kelembapan_ref' => 80,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '28 hari',
            ],
            [
                'nama_jenis_ref' => 'Kubis',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1750,
                'tmin_tds_ref' => 1750,
                't_suhu_ref' => 20,
                't_kelembapan_ref' => 60,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '90 hari',
            ],
            [
                'nama_jenis_ref' => 'Kembang Kol',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1050,
                'tmin_tds_ref' => 1050,
                't_suhu_ref' => 20,
                't_kelembapan_ref' => 60,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '90 hari',
            ],
            [
                'nama_jenis_ref' => 'Seledri',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1260,
                'tmin_tds_ref' => 1260,
                't_suhu_ref' => 24,
                't_kelembapan_ref' => 70,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '90 hari',
            ],
            [
                'nama_jenis_ref' => 'Tomat',
                't_cahaya_ref' => 15000,
                'tmax_tds_ref' => 1400,
                'tmin_tds_ref' => 1400,
                't_suhu_ref' => 26,
                't_kelembapan_ref' => 50,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '90 hari',
            ],
            [
                'nama_jenis_ref' => 'Pakcoy',
                't_cahaya_ref' => 10000,
                'tmax_tds_ref' => 1050,
                'tmin_tds_ref' => 1050,
                't_suhu_ref' => 30,
                't_kelembapan_ref' => 80,
                'tmax_ketinggian_ref' => 20,
                'tmin_ketinggian_ref' => 25,
                'tmax_ph_ref' => 6.5,
                'tmin_ph_ref' => 5.5,
                'masa_tanam' => '28 hari',
            ],
        ];

        foreach ($data as $item) {
            ReferensiJenisTanaman::create($item);
        }
    }
}
