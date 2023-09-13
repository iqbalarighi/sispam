<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtorisasiModel extends Model
{
    use HasFactory;

    protected $table = 'otorisasi';
    protected $fillable = [
        'nama', 
        'jabatan', 
        'nip', 
    ];
}
