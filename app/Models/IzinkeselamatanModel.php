<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinkeselamatanModel extends Model
{
    use HasFactory;

    protected $table = 'izin_keselamatan';

    protected $fillable = [
        'izin_id',
        'biaya',
        'aktivitas',
        'potensi_bahaya',
        'langkah_aman',
    ];

}
