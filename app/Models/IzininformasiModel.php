<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzininformasiModel extends Model
{
    use HasFactory;

    protected $table = 'izin_informasi';

    protected $fillable = [
        'izin_id',
        'pekerjaan',
        'lokasi',
        'area',
        'plant',
        'manager',
        'pemohon',
        'tel_pemohon',
        'pengawas',
        'tel_pengawas',
        'k3',
        'tel_k3',
        'perusahaan_pemohon',
        'pekerja',
        'enginer',
        'surveyor',
        'operator_alat',
        'rigger',
        'teknisi_elektrik',
        'mekanik',
        'welder',
        'fitter',
        'tukang_bangunan',
        'tukang_kayu',
        'lainnya',
        'ktp',
    ];

public function izinvendor()
    {
        return $this->belongsTo(IzinvendorModel::class, 'izin_id');
    }
}
