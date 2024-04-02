<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LayananModel extends Model
{
    use HasFactory;

    protected $table = 'layanan';
    // protected $dates = ['tanggal'];
    protected $fillable = [
        'layanan_id',
        'layanan',
        'tanggal',
        'detail_kebutuhan',
        'pic',
        'kontak',
        'email',
        'foto',
        'status',
        'puas_layanan',
        'puas_perilaku',
        'masukan',
    ];
}
