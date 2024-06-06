<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapModel extends Model
{
    use HasFactory;

    protected $table = 'rekap';
    protected $fillable = [
        'nama_file', 
        'bulan', 
    ];
}
