<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinvalidasiModel extends Model
{
    use HasFactory;

    protected $table = 'izin_validasi';

    protected $fillable = [
        'izin_id',
        'mulai_granted',
        'sampai_granted',
        'nm_pmhn_granted',
        'tgl_pmhn_granted',
        'nm_pmrks_granted',
        'tgl_pmrks_granted',
        'nm_pngws_granted',
        'tgl_pngws_granted',
        'mulai_ovtme',
        'sampai_ovtme',
        'nm_pmhn_ovtme',
        'tgl_pmhn_ovtme',
        'nm_pmrks_ovtme',
        'tgl_pmrks_ovtme',
        'nm_pngws_ovtme',
        'tgl_pngws_ovtme',
        'mulai_denied',
        'sampai_denied',
        'nm_pmhn_denied',
        'tgl_pmhn_denied',
        'nm_pmrks_denied',
        'tgl_pmrks_denied',
        'nm_pngws_denied',
        'tgl_pngws_denied',
        'ket'
    ];

public function izinvendor()
    {
        return $this->belongsTo(IzinvendorModel::class);
    }
}
