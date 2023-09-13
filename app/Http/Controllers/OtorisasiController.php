<?php

namespace App\Http\Controllers;

use App\Models\OtorisasiModel;
use Illuminate\Http\Request;

class OtorisasiController extends Controller
{
    public function index()
    {
        $otor = OtorisasiModel::paginate(15);
        return view('admin.otorisasi.index', compact('otor'));
    }

    public function simpan(Request $request)
    {
        $simpan = new OtorisasiModel;

        $simpan->nama = $request->nama;
        $simpan->jabatan = $request->jabatan;
        $simpan->nip = $request->nip;
        $simpan->save();

        return back()
        ->with('sukses', 'Berhasil Menambahkan User Otorisasi');
    }

    public function update(Request $request, $id)
    {
        $update = OtorisasiModel::findOrFail($id);

        $update->nama = $request->nama;
        $update->jabatan = $request->jabatan;
        $update->nip = $request->nip;
        $update->save();

        return back()
        ->with('sukses', 'Berhasil Merubah Data User Otorisasi');
    }

    public function hapus($id)
    {
        $hapus = OtorisasiModel::findOrFail($id);
        $nama = $hapus->nama;
        $hapus->delete();

        return back()
        ->with('sukses','Data Otorisasi Terhapus');
    }

}
