<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\IzininformasiModel;
use App\Models\IzinkeselamatanModel;
use App\Models\IzinperalatanModel;
use App\Models\IzinperlengkapanModel;
use App\Models\IzinvalidasiModel;

class IzinvendorModel extends Model
{
    use HasFactory;

    protected $table = 'izinvendor';

    protected $fillable = [
        'izin_id',
        'klasifikasi', 
        'no_dok',
        'biaya',
        'risiko',
        'status',
        'foto',
        'ket',
    ];



        public function izin_informasi()
    {
        return $this->belongsTo(IzininformasiModel::class, 'id');
    }    
        public function izin_keselamatan()
    {
        return $this->belongsTo(IzinkeselamatanModel::class, 'id');
    }
        public function izin_peralatan()
    {
        return $this->belongsTo(IzinperalatanModel::class, 'id');
    }
        public function izin_perlengkapan()
    {
        return $this->belongsTo(IzinperlengkapanModel::class, 'id');
    }        
        public function izin_validasi()
    {
        return $this->belongsTo(IzinvalidasiModel::class, 'id');
    }
}
