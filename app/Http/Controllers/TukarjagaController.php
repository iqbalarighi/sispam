<?php

namespace App\Http\Controllers;

use App\Exports\TukarjagaExport;
use App\Helpers\Helper;
use App\Models\SiteModel;
use App\Models\TukarbarangModel;
use App\Models\TukargiatModel;
use App\Models\TukarjagaModel;
use App\Models\TukarshiftModel;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class TukarjagaController extends Controller
{
    public function index(Request $request)
    {   
        $admin = Auth::user()->role;
        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;
        
        $gd = Auth::user()->lokasi_tugas;

        if (Auth::user()->level == 'koordinator') {
            if ($gd == '13') {
               if ($start != null){
                $trjg = TukarjagaModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->where('lokasi','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->whereIn('lokasi', ['1','3','14','15'])
                            ->whereBetween('tanggal', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

                    $trjg->appends(['start' => $start, 'end' => $end]);
                } else {
                 $trjg = TukarjagaModel::with('site')
                         ->where('lokasi', '=', $gd)
                         ->orwhere('lokasi', '=', '1')
                         ->orwhere('lokasi', '=', '3')
                         ->orwhere('lokasi', '=', '14')
                         ->orwhere('lokasi', '=', '15')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                }
            } else {
                if ($start != null){
                $trjg = TukarjagaModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->where('lokasi','=',$gd)
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $trjg->appends(['start' => $start, 'end' => $end]);
                }  else {
                 $trjg = TukarjagaModel::with('site')
                 ->where('lokasi', '=', $gd)
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            }
        }
        } elseif ($admin == 'admin') {
                if ($start != null){
                $trjg = TukarjagaModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $trjg->appends(['start' => $start, 'end' => $end]);
                } else {
                $trjg = TukarjagaModel::with('site')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
                }
        } else {
// Danru
                if ($cari != null) {
                $trjg = TukarjagaModel::with('site')
                        ->where([['danru','=', Auth::user()->name],['tanggal', '=', $cari]])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15);
                    $trjg->appends(['date' => $cari]);
                } else {
                $trjg = TukarjagaModel::with('site')
                ->where('danru','=', Auth::user()->name)
                ->orderBy('created_at', 'DESC')
                ->paginate(15);         
                }
    }
        
        return view('tukarjaga.index', ['trjg' => $trjg, 'start' => $start, 'end' => $end]);

    }

    public function input()
    {
       $site = SiteModel::get(); 

       return view('tukarjaga.input', ['site' => $site]);
    }

    public function detil($no_trj, $id)
    {
        $detilx = TukarjagaModel::findOrFail($id);
        $detil = TukarshiftModel::where('no_trj', '=', $detilx->no_trj)->get();
        $bar = TukarbarangModel::where('no_trj', '=', $detilx->no_trj)->get();
        $urai = TukargiatModel::where('no_trj', '=', $detilx->no_trj)->get();
       // dd($detil);
       return view('tukarjaga.detail', ['detil' => $detil, 'bar' => $bar, 'urai' => $urai, 'detilx' => $detilx]);
    }

    public function simpan(Request $request)
    {
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'TRJ-'.$th.$month.'-';
        $no_trj = Helper::IDGenerator(new TukarjagaModel, 'no_trj', 4, $string); /** Generate id */


        $request->validate([
            'shiftlama' => 'required',
            'shiftbaru' => 'required',
            'shift' => 'required',
            'uraian' => 'required',
            'nabar' => 'required',
            'jumlah' => 'required',
            'jam' => 'required',
            'ket' => 'required',
        ]);


    $danru = Auth::user()->name;    
    $tglx =  $request->tgl;
    $trj = new TukarjagaModel();
        $trj->tanggal = $tglx;
        $trj->danru = $danru;
        $trj->shift = $request->shift;
        $trj->no_trj = $no_trj;
        $trj->lokasi = $request->lokasi;
        $trj->save();

    $shift = new TukarshiftModel();
        foreach ($request->shiftlama as $key => $value) {
            $lama[] = $value;
        }

        foreach ($request->shiftbaru as $key => $val) {
            $baru[] = $val;
        }

        $shift->no_trj = $no_trj;
        $shift->shift_lama = implode('|', $lama);
        $shift->shift_baru = implode('|', $baru);
        $shift->save();
        
        $trjss = [];

        for ($i=0; $i <count($request->nabar) ; $i++) { 
            $trjss[] = $no_trj;
        }

        foreach ($request->nabar as $key => $items) {
        $barang['no_trj'] = $trjss[$key];
        $barang['nabar'] = $items;
        $barang['jumlah'] = $request->jumlah[$key];
        $barang['ket'] = $request->ket[$key];

        TukarbarangModel::create($barang);
        } 


        $trjsss = [];
        for ($i=0; $i <count($request->jam) ; $i++) { 
            $trjsss[] = $no_trj;
        }

        foreach ($request->uraian as $key => $ura) {
        $urai['no_trj'] = $trjsss[$key];
        $urai['jam'] = $request->jam[$key];
        $urai['uraian'] = $request->uraian[$key];

         TukargiatModel::create($urai);
        }

         return back()
         ->with('sukses', $no_trj.'/'.$trj->id);
    }

public function hapus($id)
{
    $hapus = TukarjagaModel::findOrFail($id);
    $shift = TukarshiftModel::where('no_trj', '=', $hapus->no_trj)->delete();
    $barang = TukarbarangModel::where('no_trj', '=', $hapus->no_trj)->delete();
    $giat = TukargiatModel::where('no_trj', '=', $hapus->no_trj)->delete();
    $hapus->delete();
    
    return back()
    ->with('sukses', 'Laporan Tukar Jaga Terhapus!');
}

public function edit($id)
{
    $edit = TukarjagaModel::findOrFail($id);
    $editshift = TukarshiftModel::where('no_trj', '=', $edit->no_trj)->get();
    $editbar = TukarbarangModel::where('no_trj', '=', $edit->no_trj)->get();
    $editgiat = TukargiatModel::where('no_trj', '=', $edit->no_trj)->get();

    return View('tukarjaga.edit', ['edit' => $edit, 'editshift' => $editshift, 'editbar' => $editbar, 'editgiat' => $editgiat, ]);
}

public function generatePDF($id)
    {   
        $detilx = TukarjagaModel::findOrFail($id);
        $detil = TukarshiftModel::where('no_trj', '=', $detilx->no_trj)->get();
        $bar = TukarbarangModel::where('no_trj', '=', $detilx->no_trj)->get();
        $urai = TukargiatModel::where('no_trj', '=', $detilx->no_trj)->get();
        $data = ['title' => 'Laporan Serah Terima Jaga'];
        $pdf = PDF::loadView('tukarjaga.savepdf', ['data' => $data, 'detil' => $detil, 'bar' => $bar, 'urai' => $urai, 'detilx' => $detilx]);
        return $pdf->stream('Laporan Serah Terima Jaga '.$detilx->no_trj.'.pdf');
    }

public function addshiftlama(Request $request, $trj, $id)
{   
    $update = TukarshiftModel::where([['id', '=', $id],['no_trj', '=', $trj]])->get();
    $shift = $request->shiftlama;
        
            if ($update[0]->shift_lama == null) {
                $tambah = $shift;
            } else {
                $tambah = $update[0]->shift_lama.'|'. $shift;
            }

            $update[0]->shift_lama = $tambah;
            $update[0]->save();

            return back()
        ->with('sukses','Personil Shift Lama Berhsil Ditambahkan');
}

public function addshiftbaru(Request $request, $trj, $id)
{   
    $update = TukarshiftModel::where([['id', '=', $id],['no_trj', '=', $trj]])->get();
    $shift = $request->shiftbaru;
        
            if ($update[0]->shift_baru == null) {
                $tambah = $shift;
            } else {
                $tambah = $update[0]->shift_baru.'|'. $shift;
            }

            $update[0]->shift_baru = $tambah;
            $update[0]->save();

            return back()
        ->with('sukses','Personil Shift Lama Berhsil Ditambahkan');
}

public function hapuslama($item, $trj)
    {   

        $shiftlama = TukarshiftModel::where('no_trj', '=', $trj)->get();
        $del = explode('|',$shiftlama[0]->shift_lama);
        $items = $del;

        $shiftToRemove = [$item];
        $shift = [];

        $collection = collect($items)->reject(function ($value) use ($shiftToRemove) {
            return in_array($value, $shiftToRemove);
        });

            foreach ($collection as $daftar) {
            $shift_list = $daftar;
            $shift[] = $shift_list;
            }

        $shiftlama[0]->shift_lama = implode('|', $shift);
        $shiftlama[0]->save();

        return back()
        ->with('sukses','Personil Shift Lama Terhapus');
    }


public function hapusbaru($item, $trj)
    {   

        $shiftbaru = TukarshiftModel::where('no_trj', '=', $trj)->get();
        $del = explode('|',$shiftbaru[0]->shift_baru);
        $items = $del;

        $shiftToRemove = [$item];
        $shift = [];

        $collection = collect($items)->reject(function ($value) use ($shiftToRemove) {
            return in_array($value, $shiftToRemove);
        });

            foreach ($collection as $shit) {
            $shift_list = $shit;
            $shift[] = $shift_list;
            }

        $shiftbaru[0]->shift_baru = implode('|', $shift);
        $shiftbaru[0]->save();

        return back()
        ->with('sukses','Personil Shift Baru Terhapus');
    }

public function hapusbarang($trj, $id)
{   
    $barang = TukarbarangModel::where([['id', '=', $id],['no_trj', 'LIKE', '%'.$trj.'%']]);

    $barang->delete();

         return back()
        ->with('sukses','Barang Inventaris Terhapus');
}

public function editinv(Request $request, $trj, $id)
{
    $inv = TukarbarangModel::where([['id', '=', $id],['no_trj', '=', $trj]])->get();
    $inv[0]->nabar = $request->nabar;
    $inv[0]->jumlah = $request->jumlah;
    $inv[0]->ket = $request->ket;
    $inv[0]->save();

        return back()
        ->with('sukses','Barang Inventaris Terupdate');
}

public function hapusgiat($trj, $id)
{
    $giat = TukargiatModel::where([['id', '=', $id],['no_trj', 'LIKE', '%'.$trj.'%']]);
    $giat->delete();

         return back()
        ->with('sukses','Laporan Kejadian/Kegiatan Berhasil Terhapus');

}

public function editgiat(Request $sini, $trj, $id)
{
    $inv = TukargiatModel::where([['id', '=', $id],['no_trj', '=', $trj]])->get();
    $inv[0]->jam = $sini->jam;
    $inv[0]->uraian = $sini->uraian;
    $inv[0]->save();

        return back()
        ->with('sukses','Laporan Terupdate');
}

public function simpaninv(Request $request, $trj)
{
    $add = new TukarbarangModel();

    $add->no_trj = $trj;
    $add->nabar = $request->nabar;
    $add->jumlah = $request->jumlah;
    $add->ket = $request->ket;
    $add->save();

        return back()
        ->with('sukses','Berhasil Menambahkan Barang Inventaris');
}

public function simpangiat(Request $request, $trj)
{
    $add = new TukargiatModel();

    $add->no_trj = $trj;
    $add->jam = $request->jam;
    $add->uraian = $request->uraian;
    $add->save();

        return back()
        ->with('sukses','Berhasil Menambahkan Laporan');
}

public function editshift(Request $ubah, $trj, $id)
{
    $shift = TukarjagaModel::where([['id', '=', $id],['no_trj', '=', $trj]])->get();

    $shift[0]->shift = $ubah->shift;
    $shift[0]->save();

         return back()
        ->with('sukses','Berhasil Ubah Shift');
}

    public function autocomplete(Request $request)
    {
        $hasil = TukarbarangModel::select("nabar")
                    ->where('nabar', 'LIKE', '%'. $request->get('term'). '%')
                    ->distinct()
                    ->get();

       $data = array();
        foreach ($hasil as $hsl)
            {
                $data[] = $hsl->nabar;
            }
     
        return response()->json($data);
    }

public function export(Request $request, $start, $end)
    {
        $start = Carbon::parse($request->start)->isoFormat('D MMMM Y');
        $end = Carbon::parse($request->end)->isoFormat('D MMMM Y');

        if ($start == $end) {

          return Excel::download(new TukarjagaExport($request->start, $request->end), 'Laporan Serah Terima Jaga '.$start.'.xlsx');  

        } else {
            return Excel::download(new TukarjagaExport($request->start, $request->end), 'Laporan Serah Terima Jaga '.$start.' - '.$end.'.xlsx');
        }

        
    }

}