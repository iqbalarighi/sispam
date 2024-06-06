<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinperlengkapanModel extends Model
{
    use HasFactory;

    protected $table = 'izin_perlengkapan';

    protected $fillable = [
        'izin_id',
        'alat',
        'jml_alat',
        'mesin',
        'jml_mesin',
        'material',
        'jml_material',
        'alat_berat',
        'jml_alat_berat',
    ];

public function izinvendor()
    {
        return $this->belongsTo(IzinvendorModel::class, 'izin_id');
    }
}
