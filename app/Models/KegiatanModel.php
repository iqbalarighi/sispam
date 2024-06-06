<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanModel extends Model
{
    use HasFactory;

    protected $table = 'kegiatan';

    protected $fillable = [
        'no_lap',
        'tanggal', 
        'gedung', 
        'danru', 
        'personil', 
        'trc ', 
        'giat ', 
        'keterangan ', 
        'foto ', 
    ];

        public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'gedung');
    }
}
