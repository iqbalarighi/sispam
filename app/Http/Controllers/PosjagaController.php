<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosjagaModel;
use App\Models\SiteModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class PosjagaController extends Controller
{
        public function index()
    {
        $pos = PosjagaModel::with('site')
        ->paginate(15);
        return view('posjaga.pos', ['pos' => $pos]);
     }

    public function edit(Request $request, $id)
    {
        $pos = PosjagaModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $pos->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $pos->site->id)->get(['id', 'nama_gd']);
        return view('posjaga.edit', ['pos' => $pos, "site" => $site, "id" => $id]);

    }

    public function hapus($id)
    {
        $hapus = PosjagaModel::findOrFail($id);
        $hapus->delete();
        return redirect('posjaga.pos');

    }

        public function hapusFoto($id)
    {
        $hapus = PosjagaModel::findOrFail($id);
        $folder = $hapus->id_jaga;
        $foto = $hapus->foto;

       $del = File::delete(public_path('storage/posjaga/'.$folder.'/'.$foto.''));

       if ($del == true) {
            $hapus->foto = '';
            $hapus->save();
       } 
       return back()
             ->with('status','Foto Profil Terhapus');
    }

    public function update(Request $request, $id)
    {   
        $validator = $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
        ],
        [
            'foto.image' => 'Foto Profil harus berupa File Gambar',
            'foto.mimes' => 'File Gambar yang diterima dengan format :values',
        ]);

        $simpan = PosjagaModel::findOrFail($id);
        
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $idjg = $simpan->id_jaga;
        $string = $th.$month.$idjg;

        $ft = $simpan->foto;

        if ($request->file('foto') != null) {
            
            if (File::exists(public_path('storage/posjaga/'.$idjg.'/'.$ft.''))) 
            {
                File::delete(public_path('storage/posjaga/'.$idjg.'/'.$ft.''));
            }
            
            $ext = $request->file('foto')->getClientOriginalExtension();            
            $imageName = $string.'.'.$ext;
            $request->file('foto')->move(public_path('storage/posjaga/'.$idjg.'/'), $imageName);
            
            $simpan->foto = $imageName;
            $simpan->save();
        } 

        $simpan->pos_jaga = $request->pos;
        $simpan->gedung = $request->gedung;
        $simpan->area_jaga = $request->area;
        $simpan->kategori_ring = $request->ring;
        $simpan->personil_jaga = $request->jaga;
        $simpan->standar_peralatan = $request->alat;
        $simpan->save();

        return redirect('posjaga')
            ->with('berhasil','Data berhasil di Update'); 
    }


}
