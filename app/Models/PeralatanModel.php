<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeralatanModel extends Model
{
    use HasFactory;

    protected $table = 'peralatan';
    protected $fillable = [
        'alat', 
        'no_inventaris', 
        'satuan', 
        'jumlah', 
        'gedung', 
        'ruang ', 
        'milik ', 
        'kondisi', 
        'riwayat', 
    ];

    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'gedung');
    }
}
