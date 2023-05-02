<?php

namespace App\Http\Controllers;
use App\Models\SiteModel;
use Illuminate\Http\Request;


class SiteController extends Controller
{
    public function index()
    {
        $site = SiteModel::select('*')->paginate(20);
        return view('site.gedung', ['site' => $site]);
     }

    public function edit(Request $request, $id)
     {
         $site = SiteModel::findOrFail($id);
         return view('site.edit', ['site' => $site]);
     }

    public function hapus($id)
    {
        $hapus = SiteModel::findOrFail($id);
        $nama = $hapus->nama_gd;
        $hapus->delete();

        return back()
        ->with('sukses','Gedung '.$nama.' Terhapus');
    }

    public function simpan(Request $request)
    {
        $validator = $request->validate([
            'kode' => 'unique:site',
        ],
        [
            'kode.unique' => 'Kode Yang Anda Masukkan Sudah Digunakan !',
        ]);

        $site = new SiteModel;
        $site->kode = $request->kode;
        $site->nama_gd = $request->gedung;
        $site->alamat_gd = $request->alamat;
        $site->nopon = $request->nopon;
        $site->save();

        return back()
        ->with('success','Data berhasil Tersimpan.');
    }

    public function update(Request $request, $id)
    {
        $site = SiteModel::findOrFail($id);

        // $site->kode = $request->kode;
        $site->nama_gd = $request->gedung;
        $site->alamat_gd = $request->alamat;
        $site->nopon = $request->nopon;
        $site->save();

        return redirect('site')
        ->with('sukses','Update Data '.$site->nama_gd.' berhasil');
    }

}
