<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ParkirModel;
use Illuminate\Pagination\Paginator;

class ParkirController extends Controller
{
    public function index(Request $request)
    {   
        $cari = $request->cari;
        if ($cari != null) {
             $parkir = ParkirModel::where('nama', 'LIKE', '%'.$cari.'%')
             ->orwhere('kode', 'LIKE', '%'.$cari.'%')
             ->orwhere('lantai', 'LIKE', '%'.$cari.'%')
             ->orwhere('nip', 'LIKE', '%'.$cari.'%')
             ->orwhere('jabatan', 'LIKE', '%'.$cari.'%')
             ->orderby('kode', 'ASC')
             ->paginate(15)
             ->appends(request()->input());

        return view('parkir.parkir', compact('parkir'));
        } else {
         $parkir = ParkirModel::orderby('kode', 'ASC')
         ->paginate(15);
        return view('parkir.parkir', compact('parkir'));   
        }
     }

    public function simpan(Request $request)
     {
        $validator = $request->validate([
            'nip' => 'unique:parkir',
            'kode' => 'unique:parkir',
        ],
        [
            'nip.unique' => 'Nip Yang Anda Masukkan Sudah Terdaftar !',
            'kode.unique' => 'Kode Yang Anda Masukkan sudah Terdaftar !',]
        );

         $simpan = new ParkirModel;
         $simpan->kode = $request->kode;
         $simpan->lantai = $request->lantai;
         $simpan->nip = $request->nip;
         $simpan->nama = $request->nama;
         $simpan->jabatan = $request->jabatan;
         $simpan->akses = $request->akses;
         $simpan->aktif = $request->aktif;
         $simpan->keterangan = $request->keterangan;
         $simpan->save();

         return redirect('parkir')
         ->with('status','Data Lot Parkir Berhasil Ditambah');
     } 

     public function edit(Request $request,$id)
     {
         $parkir = ParkirModel::findOrFail($id);

         return view('parkir.edit', ['parkir' => $parkir]);
     }

     public function hapus($id)
     {
        $hapus = ParkirModel::findOrFail($id);
         $hapus->delete();
         
        return redirect('parkir')
        ->with('status', 'Data terhapus');
     }

    public function update(Request $request, $id)
     {
        $simpan = ParkirModel::findOrFail($id);

         // $simpan->kode = $request->kode;
         $simpan->lantai = $request->lantai;
          $simpan->nip = $request->nip;
         $simpan->nama = $request->nama;
         $simpan->jabatan = $request->jabatan;
         $simpan->akses = $request->akses;
         $simpan->aktif = $request->aktif;
         $simpan->keterangan = $request->keterangan;
         $simpan->save();

         return redirect('parkir')
         ->with('status','Data Lot Parkir '.$simpan->nama.' Berhasil Diubah');
     } 
}
