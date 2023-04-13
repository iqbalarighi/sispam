<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArsipModel extends Model
{
    use HasFactory;

    protected $table = 'arsip';

    protected $fillable = [
        'no_arsip', 
        'tahun', 
        'uraian', 
        'lokasi_fisik', 
        'file ', 
    ];
}
