<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnrasModel extends Model
{
    use HasFactory;

    protected $table = 'unras';
    protected $fillable = [
        'tanggal', 
        'waktu', 
        'tempat_kegiatan', 
        'pelaksana', 
        'tuntutan', 
        'bentuk_kegiatan', 
        'jumlah_massa', 
        'status_kegiatan', 
        'level_resiko', 
        'sifat_kegiatan', 
        'keterangan', 
        'creator', 
        'editor', 
    ];
}
