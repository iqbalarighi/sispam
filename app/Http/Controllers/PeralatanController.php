<?php

namespace App\Http\Controllers;
use App\Models\PeralatanModel;
use App\Models\SiteModel;
use Illuminate\Http\Request;


class PeralatanController extends Controller
{
        public function index()
    {
        $alat = PeralatanModel::with('site')
        ->paginate(15);
        return view('peralatan.index', ['alat' => $alat]);
     }
 
     // public function edit(Request $request, $id)
     // {
     //     $alat = PeralatanModel::findOrFail($id);
     //     return view('peralatan.edit', ['alat' => $alat]);
 
     // }

         public function edit(Request $request, $id)
    {
        $alat = PeralatanModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $alat->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $alat->site->id)->get(['id', 'nama_gd']);
        return view('peralatan.edit', ['alat' => $alat, "site" => $site, "id" => $id]);
    }
 
     public function hapus($id)
     {
        $hapus = PeralatanModel::findOrFail($id);
         $hapus->delete();
         
        return redirect('peralatan');
     }

    public function showInput()
    {
        $site = SiteModel::all();
        return view('peralatan.input', ['site' => $site]);

    }

     public function simpan(Request $request)
     {
         $simpan = new PeralatanModel;
         $simpan->alat = $request->alat;
         $simpan->no_inventaris = $request->noinv;
         $simpan->satuan = $request->satuan;
         $simpan->jumlah = $request->jumlah;
         $simpan->gedung = $request->gedung;
         $simpan->ruang = $request->ruang;
         $simpan->milik = $request->milik;
         $simpan->kondisi = $request->kondisi;
         $simpan->riwayat = $request->riwayat;
         $simpan->save();

         return redirect('peralatan');
     }

     public function update(Request $request, $id)
     {
         $alat = PeralatanModel::findOrFail($id);

         $alat->satuan = $request->satuan;
         $alat->jumlah = $request->jumlah;
         $alat->gedung = $request->gedung;
         $alat->ruang = $request->ruang;
         $alat->milik = $request->milik;
         $alat->kondisi = $request->kondisi;
         $alat->riwayat = $request->riwayat;
         $alat->save();

         return redirect('peralatan')
         ->with('status','Perubahan Data Berhasil');
     }

}
