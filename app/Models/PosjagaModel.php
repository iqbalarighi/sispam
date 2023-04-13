<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosjagaModel extends Model
{
    use HasFactory;

    protected $table = 'posjaga';
    protected $fillable = ['id_jaga','pos_jaga','gedung','area_jaga','kategori_ring','personil_jaga','standar_peralatan','foto'];

    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'gedung');
    }

}
