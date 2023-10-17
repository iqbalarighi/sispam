<?php

namespace App\Http\Controllers;

use App\Models\RekapModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->cari;
        $start = $request->start;
        $end = $request->end;


        if ($cari != null) {
           $rekap = RekapModel::where('nama_file','LIKE', '%'.$cari.'%')
           ->paginate(15);
        $rekap->appends(compact('cari'));

           return view('rekap.index', compact('rekap'));
        } 
        else {
        $rekap = RekapModel::orderBy('id', 'DESC')->paginate(
    $perPage = 15, $columns = ['*'], $pageName = 'halaman'
);
        return view('rekap.index', compact('rekap'));
        }

    }

    public function create()
    {
        return view('rekap.input');
    }

    public function store(Request $request)
    {
        $store = new RekapModel;

        $validator = $request->validate([
            'rekap.*' => 'mimes:pdf',
        ],
        [
            'rekap.*.mimes' => 'Hanya menerima format :values',
        ]);        

        $files = $request->file('rekap');
        $filesx = [];

        $tahun = Carbon::parse($request->bulan)->isoFormat('YYYY');
        $bulan = Carbon::parse($request->bulan)->isoFormat('MMMM');

        if ($files != null) {
            foreach ($files as $file) {
                $files_name = $file->getClientOriginalName();
                $name = pathinfo($files_name,PATHINFO_FILENAME);
                $ext = strtolower($file->getClientOriginalExtension());
                $files_full_name = $name.'.'.$ext;
                
                $file->move(public_path('storage/rekap/'.$tahun.'/'.$bulan.'/'), $files_full_name);
                $filesx[] = $files_full_name;

        $item['nama_file'] = $files_full_name;
        $item['bulan'] = $request->bulan;
       
        RekapModel::create($item);
            }
        }


       return back()
       ->with('status', 'Input Rekap berhasil !');
    }

    public function show($id)
    {
        $show = RekapModel::findOrFail($id);

        return view('rekap.detil', compact('show'));
    }

    public function destroy($id)
    {
        $destroy = RekapModel::findOrFail($id);
        $tahun = Carbon::parse($destroy->bulan)->isoFormat('YYYY');
        $bulan = Carbon::parse($destroy->bulan)->isoFormat('MMMM');
        $file = $destroy->nama_file;

        $del = File::delete(public_path('storage/rekap/'.$tahun.'/'.$bulan.'/'.$file));

       if ($del == true) {
            $destroy->delete();
        return back()
       ->with('status', 'Arsip '.$file.' Sudah Terhapus');
       } else {
        return back()
       ->with('error', 'Arsip '.$file.' Gagal Terhapus, Mohon hubungi ADMIN !.');
       }
    }

}


