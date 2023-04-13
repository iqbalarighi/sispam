<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonilModel extends Model
{
    use HasFactory;

    protected $table = 'personil';
    protected $fillable = ['nip', 'nama', 'jabatan', 'gender', 'pendidikan', 'lokasi_tugas', 'kd', 'no_hp', 'alamat', 'bank', 'norek', 'bpjs_sehat','foto_bpjss', 'bpjs_kerja','foto_bpjsk', 'lama_kerja'];

    public function site()
    {
        return $this->belongsTo('App\Models\SiteModel', 'lokasi_tugas');
    }
}
