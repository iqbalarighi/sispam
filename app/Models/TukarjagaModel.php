<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TukarjagaModel extends Model
{
    use HasFactory;

    protected $table = 'tukarjaga';
    protected $fillable = [
        'no_trj', 
        'lokasi', 
        'shift',
    ];

        
    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'lokasi');
    }
}
