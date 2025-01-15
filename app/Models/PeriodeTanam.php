<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeTanam extends Model
{
    use HasFactory;

    protected $table = 'periode_tanam';

    protected $fillable = [
        'id_greenhouse',
        'tanggal_tanam',
        'tanggal_panen',
        'keterangan',
    ];

    public function greenhouse()
    {
        return $this->belongsTo(Greenhouse::class, 'id_greenhouse', 'id_greenhouse');
    }
    
}
