<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IzinperalatanModel extends Model
{
    use HasFactory;

    protected $table = 'izin_peralatan';

    protected $fillable = [
        'izin_id',
        'pelindung_diri',
        'perlengkapan',
    ];
}
