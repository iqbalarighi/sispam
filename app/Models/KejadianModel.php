<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KejadianModel extends Model
{
    use HasFactory;

    protected $table = 'kejadian';
    protected $dates = ['waktu_kejadian'];
    protected $fillable = [
        'jenis_kejadian',
        'user_pelapor',
        'lokasi_kejadian',
        'waktu_kejadian',
        'jam_kejadian',
        'jenis_potensi',
        'penyebab',
        'saksi_mata',
        'korban',
        'kerugian',
        'uraian_singkat',
        'sebab_tindakan',
        'sebab_kondisi',
        'sebab_dasar',
        'tindak_perbaikan',
        'rencana_perbaikan',
        'kom_mng_rep',
        'dokumentasi',
        'nama_pelapor',
        'uker_pelapor'
    ];

        public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'lokasi_kejadian');
    }
}
