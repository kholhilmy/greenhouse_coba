<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Greenhouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_greenhouse',
        'id',
        'waktu_tanam',
        'id_jenis',
        'tong',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function jenisTanaman()
    {
        return $this->belongsTo(JenisTanaman::class, 'id_jenis');
    }

    public function sensor()
    {
        return $this->hasOne(Sensor::class, 'id_greenhouse');
    }

    
}
