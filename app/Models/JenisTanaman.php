<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisTanaman extends Model
{
    use HasFactory;

    protected $table = 'jenis_tanamans';

    protected $primaryKey = 'id_jenis';

    protected $fillable = [
        'id_greenhouse',
        'nama_jenis',
        'tmax_ph',
        'tmin_ph',
        't_suhu',
        't_cahaya',
        'tmax_ketinggian',
        'tmin_ketinggian',
        't_kelembapan',
        'tmax_tds',
        'tmin_tds',
    ];

    public function greenhouses()
    {
        return $this->hasMany(Greenhouse::class, 'id_jenis');
        
    }
}