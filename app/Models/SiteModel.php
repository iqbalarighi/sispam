<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteModel extends Model
{
    use HasFactory;

    protected $table = 'site';
    protected $fillable = ['kode', 'nama_gd', 'alamat_gd', 'nopon'];

    public function personil()
    {
        return $this->hasOne('App\Models\PersonilModel');
    }

    public function peralatan()
    {
        return $this->hasOne('App\Models\PeralatanModel');
    }

    public function posjaga()
    {
        return $this->hasOne('App\Models\PosjagaModel');
    }

    public function kegiatan()
    {
        return $this->hasOne('App\Models\KegiatanModel');
    }

        public function tukarjaga()
    {
        return $this->hasOne('App\Models\TukarjagaModel');
    }

        public function user()
    {
        return $this->hasOne('App\Models\user');
    }

        public function bencana()
    {
        return $this->hasOne('App\Models\BencanaModel');
    }

        public function smc()
    {
        return $this->hasOne('App\Models\SmcModel');
    }
}
