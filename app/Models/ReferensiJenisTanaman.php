<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferensiJenisTanaman extends Model
{
    use HasFactory;

    protected $table = 'referensi_jenis_tanaman'; // Nama tabel

    // Kolom yang boleh diisi
    protected $fillable = [
        'nama_jenis_ref',
        'tmax_ph_ref',
        'tmin_ph_ref',
        't_suhu_ref',
        't_cahaya_ref',
        'tmax_ketinggian_ref',
        'tmin_ketinggian_ref',
        't_kelembapan_ref',
        'tmax_tds_ref',
        'tmin_tds_ref',
        'masa_tanam',
    ];
}

