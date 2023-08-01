<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BencanaModel extends Model
{
    use HasFactory;

    protected $table = 'bencana';

    protected $fillable = [
            'no_bencana',
            'tanggal',
            'lokasi',
            'jenis_bencana',
            'nama_pelapor',
            'satker',
            'kejadian_bencana',
            'kronologi_bencana',
            'penanganan',
            'foto',
    ];

        public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'lokasi');
    }
}
