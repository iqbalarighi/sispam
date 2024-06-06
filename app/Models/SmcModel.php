<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmcModel extends Model
{
    use HasFactory;

    protected $table = 'smc';
    protected $fillable = [
        'no_lap',
        'tanggal', 
        'gedung', 
        'shift',
        'creator', 
        'petugas', 
        'giat', 
        'keterangan ', 
        'foto ', 
    ];

    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'gedung');
    }
}
