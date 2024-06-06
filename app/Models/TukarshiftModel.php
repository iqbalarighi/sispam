<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarshiftModel extends Model
{
    use HasFactory;

    protected $table = 'tukarshift';
    protected $fillable = [
        'no_trj', 
        'tanggal', 
        'danru', 
        'shift_lama', 
        'shift_baru', 
    ];
}
