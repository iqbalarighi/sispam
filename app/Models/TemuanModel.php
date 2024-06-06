<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemuanModel extends Model
{
    use HasFactory;

    protected $table = 'temuan';
    protected $fillable = [
        'tanggal', 
        'no_lap', 
        'pelapor', 
        'jam', 
        'area', 
        'lokasi', 
        'jenis_bahaya', 
        'potensi_bahaya', 
        'pengendalian', 
        'foto', 
        'status', 
    ];

    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'lokasi');
    }
}