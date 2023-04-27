<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Models\TukarjagaModel;
use App\Models\TukarshiftModel;
use App\Models\TukarbarangModel;
use App\Models\TukargiatModel;
use App\Models\SiteModel;
use Carbon\Carbon;
use DB;
use PDF;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class tukarjagaController extends Controller
{
    public function index()
    {   
        $admin = Auth::user()->role;
        if ($admin == 'admin') {
        $trjg = TukarjagaModel::with('site')
        ->orderBy('created_at', 'DESC')
        ->paginate(15);

        } else {
        $trjg = TukarjagaModel::with('site')
        ->where('danru','=', Auth::user()->name)
        ->orderBy('created_at', 'DESC')
        ->paginate(15);         
        }
        
return view('tukarjaga.index', ['trjg' => $trjg]);

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

         return redirect('tukarjaga')
         ->with('sukses', 'Laporan Berhasil Terkirim');;
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
        $data = ['title' => 'Laporan Tukar Jaga'];
        $pdf = PDF::loadView('tukarjaga.savepdf', ['data' => $data, 'detil' => $detil, 'bar' => $bar, 'urai' => $urai, 'detilx' => $detilx]);
        return $pdf->download('Laporan Tukar Jaga '.$detilx->no_trj.'.pdf');
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
        ->with('sukses','Poin Kejadian/Kegiatan Terhapus');

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

}