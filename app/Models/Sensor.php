<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_sensor';

    protected $fillable = [
        'id_greenhouse',
        'suhu_data',
        'kelem_data',
        'cahaya_data',
        'ketinggian_data',
        'ph_data',
        'tds_data',
    ];

    public function greenhouse()
    {
        return $this->belongsTo(Greenhouse::class, 'id_greenhouse');
    }
}
