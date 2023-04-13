<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParkirModel extends Model
{
    use HasFactory;

    protected $table = 'parkir';
    protected $fillable = [
        'kode', 
        'lantai', 
        'nip', 
        'nama', 
        'jabatan ', 
        'akses', 
        'aktif', 
        'keterangan', 
    ];

    // public function site()
    // {
    //     return $this->belongsTo('App\Models\SiteModel', 'gedung');
    // }
}
