<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ArsipModel;
use App\Helpers\Helper;
use Illuminate\Support\Facades\File;


class ArsipController extends Controller
{
   public function index()
   {
        $arsip = ArsipModel::paginate(15);
        return view('arsip.index', ['arsip' => $arsip]);
   }

   public function gen()
   {
        $string = 'PAM/ARSIP/';

        $gen = Helper::IDGenerator(new ArsipModel, 'no_arsip', 3, $string); /** Generate id */

        return view('arsip.input', ['gen' => $gen]);
   }

   public function simpan(Request $request)
   {
        $validator = $request->validate([
            'arsip' => 'required|mimes:pdf',
        ],
        [
            'arsip.required' => 'Mohon Upload File Arsip',
            'arsip.mimes' => 'File Arsip yang diterima dengan format :values',
            
        ]);

       $simpan = new ArsipModel;
        $tahun = $request->tahun;
        $nm_arsip = $request->nm_arsip;
        
        if ($request->file('arsip') != null) {
        $ext = $request->file('arsip')->getClientOriginalExtension();
        $fileName = $nm_arsip.'-'.$tahun.'.'.$ext;
            $request->file('arsip')->move(public_path('storage/arsip/'.$tahun.'/'), $fileName);
        }

       $simpan->no_arsip = $request->norsip;
       $simpan->nm_arsip = $request->nm_arsip;
       $simpan->tahun = $request->tahun;
       $simpan->uraian = $request->uraian;
       $simpan->lokasi_fisik = $request->losik;
       $simpan->file = $fileName;
       $simpan->save();

       return back()
       ->with('status', 'Input berhasil !');
   }

    public function hapus($id)
    {
        $hapus = ArsipModel::findOrFail($id);
        $hapus->delete();
        
       return back()
       ->with('status', 'Berhasil Terhapus');

    }

public function edit($id)
{
    $edit = ArsipModel::findOrFail($id);

    return view('arsip.edit',['edit' => $edit]);
}

public function hapusFile($id)
{
    $hapus = ArsipModel::findOrFail($id);
    $tahun = $hapus->tahun;
    $file = $hapus->file;

    $del = File::delete(public_path('storage/arsip/'.$tahun.'/'.$file));

       if ($del == true) {
            $hapus->file = "";
            $hapus->save();

        return back()
       ->with('success', 'Arsip '.$file.' Sudah Terhapus');
       } else {
        return back()
       ->with('error', 'Arsip '.$file.' Gagal Terhapus, Mohon hubungi ADMIN !.');
       }
}

public function update(Request $request, $id)
{
       $update = ArsipModel::findOrFail($id);
        $tahun = $request->tahun;
        $nm_arsip = $request->nm_arsip;
        

        if ($request->file('arsip') != null) {
         $ext = $request->file('arsip')->getClientOriginalExtension();
        $fileName = $nm_arsip.'-'.$tahun.'.'.$ext;
            $request->file('arsip')->move(public_path('storage/arsip/'.$tahun.'/'), $fileName);
        } else {
            $fileName = '';
        }

       $update->no_arsip = $request->no_arsip;
       $update->nm_arsip = $request->nm_arsip;
       $update->tahun = $request->tahun;
       $update->uraian = $request->uraian;
       $update->lokasi_fisik = $request->lokasi_fisik;
       $update->file = $fileName;
       $update->save();

       return back()
       ->with('success', 'Update berhasil !');
}

}