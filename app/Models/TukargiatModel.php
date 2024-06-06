<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukargiatModel extends Model
{
    use HasFactory;

    protected $table = 'tukargiat';
    protected $fillable = [
        'no_trj',
        'jam', 
        'uraian', 
    ];
}
