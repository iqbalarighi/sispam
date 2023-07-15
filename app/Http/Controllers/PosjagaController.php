<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PosjagaModel;
use App\Models\SiteModel;
use App\Helpers\Helper;
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

    public function tambah()
    {
        $site = SiteModel::get();

         return view('posjaga.input', compact('site'));
    }


    public function hapusFoto($item, $id)
    {
        $foto = PosjagaModel::findOrFail($id);
        $del = explode('|',$foto->foto);
        $items = $del;

        $hapuspoto = [$item];
        $poto = [];

        $collection = collect($items)->reject(function ($value) use ($hapuspoto) {
            return in_array($value, $hapuspoto);
        });

            foreach ($collection as $file) {
            $image_name = $file;
            $poto[] = $image_name;
            }

        $dele = File::delete(public_path('storage/posjaga/'.$foto->id_jaga.'/'.$item));

        if ($dele == true) {
        $foto->foto = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('status','Foto Pos Jaga Terhapus !');
    }

    public function simpan(Request $request)
    {   
        $validator = $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:4096',
        ],
        [
            'foto.image' => 'Foto Profil harus berupa File Gambar',
            'foto.mimes' => 'File Gambar yang diterima dengan format :values',
        ]);

        
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);

        $string = 'POS-'.$th.$month.'-';

        $idjaga = Helper::IDGenerator(new PosjagaModel, 'id_jaga', 4, $string); /** Generate id */

        $files = $request->file('images');

        $image = [];

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/posjaga/'.$idjaga.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
        $simpan->foto = implode('|', $image);
        }

        $simpan = new PosjagaModel;
        $simpan->id_jaga = $idjaga;
        $simpan->pos_jaga = $request->pos;
        $simpan->gedung = $request->gedung;
        $simpan->area_jaga = $request->area;
        $simpan->kategori_ring = $request->ring;
        $simpan->personil_jaga = $request->person;
        $simpan->standar_peralatan = $request->alat;
        $simpan->save();

            return back()
            ->with('berhasil', 'Laporan Berhasil Terkirim');
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

        $files = $request->file('images');

        $image = [];
        if ($files != null) {
            foreach ($files as $file) {
            $image_name = md5(rand(100, 1000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $image_path = public_path('storage/posjaga/'.$idjg.'/');
            $image_url = $image_path.$image_full_name;
            $file->move($image_path, $image_full_name);
            $image[] = $image_full_name;
            } 

            if ($simpan->foto == null) {
                $tambah = implode('|', $image);
            } else {
                $tambah = $simpan->foto.'|'.implode('|', $image);
            } 

        $simpan->pos_jaga = $request->pos;
        $simpan->gedung = $request->gedung;
        $simpan->area_jaga = $request->area;
        $simpan->kategori_ring = $request->ring;
        $simpan->personil_jaga = $request->jaga;
        $simpan->standar_peralatan = $request->alat;
        $simpan->foto = $tambah;
        $simpan->save();

        return back()
            ->with('status','Data berhasil di Update'); 
    }
}




}
 