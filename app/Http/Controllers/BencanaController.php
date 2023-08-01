<?php

namespace App\Http\Controllers;

use App\Models\BencanaModel;
use App\Models\SiteModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use PDF;

class BencanaController extends Controller
{
    public function index()
    {
        $bencana = BencanaModel::with('site')->paginate(15);
         return view('bencana.index', compact('bencana'));
    }

    public function tambah()
    { 
        $site = SiteModel::get();
         return view('bencana.input',compact('site'));
    }

    public function simpan(Request $request)
    {    $bencana = new BencanaModel;

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'SMC-'.$th.$month.'-';
        $nolap = Helper::IDGenerator($bencana, 'no_bencana', 4, $string); /** Generate id */

        $bncn = $request->jenis_bencana;
        if (is_array($request->jenis_bencana)) {
            $dian = array_slice($request->jenis_bencana,-2,1);
            $keja = implode('', $dian);
            $abc = end($bncn);
            $bncna = $keja.' '.$abc;
        } else {
           $bncna = $request->jenis_bencana;
        }

    $files = $request->file('images');
        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/bencana/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
          $gambar_dok = implode('|', $image);
        }

        $bencana->no_bencana = $nolap;
        $bencana->tanggal = $request->tgl;
        $bencana->lokasi = $request->gedung;
        $bencana->jenis_bencana = $bncna;
        $bencana->nama_pelapor = $request->pelapor;
        $bencana->satker = $request->satker;
        $bencana->kejadian_bencana = $request->kejadian_bencana;
        $bencana->kronologi_bencana = $request->kronologi_bencana;
        $bencana->penanganan = $request->penanganan;
        $bencana->foto = $gambar_dok;
        $bencana->save();

        return back()
        ->with('success', 'Laporan Berhasil Dibuat.');
    }


    public function edit(Request $request, $id)
{
        $edit = BencanaModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $edit->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $edit->site->id)->get(['id', 'nama_gd']);
        return view('bencana.edit', ['edit' => $edit, "site" => $site, "id" => $id]);
}

    public function hapusFoto($item, $id)
    {
        $foto = BencanaModel::findOrFail($id);
        $del = explode('|',$foto->foto);
        $items = $del;

        $target = [$item];
        $poto = [];

        $collection = collect($items)->reject(function ($value) use ($target) {
            return in_array($value, $target);
        });

            foreach ($collection as $file) {
            $image_name = $file;
            $poto[] = $image_name;
            }

        $dele = File::delete(public_path('storage/bencana/'.$foto->no_bencana.'/'.$item));

        if ($dele == true) {
        $foto->foto = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('success','Hapus Foto Berhasil');
    }

public function detil($id)
{
    $detil = BencanaModel::with('site')->findOrFail($id);
   return view('bencana.detil', compact('detil'));
}
}
