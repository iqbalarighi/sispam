<?php

namespace App\Http\Controllers;

use App\Exports\UnrasExport;
use App\Models\UnrasModel;
use Carbon\Carbon;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class UnrasController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;
        if (Auth::user()->role == 'admin') {
            if ($start != null){
                $unras = UnrasModel::whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $unras->appends(['start' => $start, 'end' => $end]);

                $cektest = UnrasModel::whereNull('editor')
                ->whereBetween('tanggal', [$start, $end])
                ->get();
                return view('unras.index', compact('unras','start','end','cari','cektest'));
                } else {
                    $unras = UnrasModel::orderBy('created_at', 'DESC')
                ->paginate(15);
                }
        } else {
            if ($cari != null) {
                $unras = UnrasModel::where('tanggal','LIKE', '%'.$cari.'%')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);
                    $unras->appends(['date' => $cari]);

                } else {
                $unras = UnrasModel::orderBy('created_at', 'DESC')
                ->paginate(15);
        }
        }


        return view('unras.index', compact('unras','start','end','cari'));
    }

    public function simpan(Request $request)
    {
        $tanggal = Carbon::parse($request->tanggal)->isoFormat('DD/MM/YYYY');

        $jam = Carbon::parse($request->tanggal)->isoFormat('HH:mm');

        $simpan = new UnrasModel;

        $giat = $request->kegiatan;
    if (is_array($request->kegiatan)) {
        $dian = array_slice($request->kegiatan,-2,1);
        $keja = implode('', $dian);
        $abc = end($giat);
        $kegiatan = $keja.' '.$abc;
    } else {
       $kegiatan = $request->kegiatan;
    }

        $simpan->tanggal = $request->tanggal;
        $simpan->waktu = $jam;
        $simpan->tempat_kegiatan = $request->tempat;
        $simpan->pelaksana = $request->pelaksana;
        $simpan->tuntutan = $request->tuntut;
        $simpan->bentuk_kegiatan = $kegiatan;
        $simpan->jumlah_massa = $request->jumlah;
        $simpan->level_resiko = $request->level;
        $simpan->sifat_kegiatan = $request->sifat;
        $simpan->keterangan = $request->ket;
        $simpan->creator = Auth::user()->name;
        $simpan->save();

        return back()
        ->with('berhasil', 'Sukses');

    }

    public function automasi(Request $request)
    {
        $hasil = UnrasModel::select("pelaksana")
                    ->where('pelaksana', 'LIKE', '%'. $request->get('term'). '%')
                    ->distinct()
                    ->get();

       $data = array();
        foreach ($hasil as $hsl)
            {
                $data[] = $hsl->pelaksana;
            }

        return response()->json($data);
    }

        public function automasi2(Request $request)
    {
        $hasil = UnrasModel::select("tempat_kegiatan")
                    ->where('tempat_kegiatan', 'LIKE', '%'. $request->get('term'). '%')
                    ->distinct()
                    ->get();

       $data2 = array();
        foreach ($hasil as $hsl)
            {
                $data2[] = $hsl->tempat_kegiatan;
            }

        return response()->json($data2);
    }


public function update(Request $request, $id)
{
    $update = UnrasModel::findOrFail($id);

    $jam = Carbon::parse($request->waktu2)->isoformat('HH:mm');

    $giat = $request->kegiatan2;
    if (is_array($request->kegiatan2)) {
        $dian = array_slice($request->kegiatan2,-2,1);
        $keja = implode('', $dian);
        $abc = end($giat);
        $kegiatan = $keja.' '.$abc;
    } else {
       $kegiatan = $request->kegiatan2;
    }

    $sif = $request->status;
    if (is_array($request->status)) {
        $dia = array_slice($request->status,-2,1);
        $kej = implode('', $dia);
        $abcd = end($sif);
        $stat = $kej.' '.$abcd;
    } else {
       $stat = $request->status;
    }
        $update->tanggal = $request->tanggal2;
        $update->waktu = $jam;
        $update->tempat_kegiatan = $request->tempat2;
        $update->pelaksana = $request->pelaksana2;
        $update->tuntutan = $request->tuntut2;
        $update->bentuk_kegiatan = $kegiatan;
        $update->jumlah_massa = $request->jumlah2;
        $update->level_resiko = $request->level2;
        $update->sifat_kegiatan = $request->sifat2;
        $update->status_kegiatan = $stat;
        $update->keterangan = $request->ket2;
        $update->editor = Auth::user()->name;
        $update->save();

        return back()
        ->with('berhasil', 'Update Sukses');
}


     public function hapus($id)
     {
        $hapus = UnrasModel::findOrFail($id);
         $hapus->delete();
         
        return back()
        ->with('berhasil', 'Data UNRAS Terhapus');
     }

    public function export(Request $request, $start, $end, $count)
    {
        $cektest = UnrasModel::whereNull('editor')
        ->whereBetween('tanggal', [$request->start, $request->end])
        ->get();

        if ($cektest->count() == 0){
        $start = Carbon::parse($request->start)->isoFormat('D MMMM Y');
        $end = Carbon::parse($request->end)->isoFormat('D MMMM Y');
        
        if ($start == $end) {
            return Excel::download(new UnrasExport($request->start, $request->end, $request->count), 'Rekap UNRAS '.$start.'.xlsx');  
        } else {
            return Excel::download(new UnrasExport($request->start, $request->end, $request->count), 'Rekap UNRAS '.$start.' - '.$end.'.xlsx');
        }            
    } else {
        return back()
        ->with('warning', 'Lakukan Update Pada Status Kegiatan Berikut');
    }
    }

public function unrasPDF($start, $end)
    {   
        $unras = UnrasModel::whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

        
        $pdf = PDF::loadView('unras.savepdf', compact('unras','start','end'))->setPaper('a4', 'landscape');

        // return $pdf->download('Laporan Kejadian/Insiden '.$detil->no_lap.'.pdf');
        if ($start == $end) {
        return $pdf->download('Rekap UNRAS '.$start.'.pdf');
        } else {
        return $pdf->download('Rekap UNRAS '.$start.'-'.$end.'.pdf');
        }
    }
}


//tambah tabel creator + editor

//kerjaan baru :
//laporan Bencana