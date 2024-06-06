<?php

namespace App\Http\Controllers;

use PDF;
use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\SiteModel;
use App\Models\TemuanModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;


class TemuanController extends Controller
{
    public function index(Request $request)
    {

        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;

        if (Auth::user()->role == 'admin'||Auth::user()->level == 'koordinator'){
            if ($start != null) {
               $temu = TemuanModel::with('site')
               ->whereBetween('tanggal', [$start, $end])
               ->orderBy('tanggal', 'DESC')
               ->paginate(15);

               $temu->appends(compact('temu','start','end','cari'));
               $user = TemuanModel::with('site')->first();
               return view('temuan.index', compact('temu','start','end','cari','user'));
            } else {
                    $temu = TemuanModel::with('site')->latest()->paginate(15);
    $user = TemuanModel::with('site')->first();
         return view('temuan.index', compact('temu','start','end','cari','user'));
            }
        } else {
            if ($cari != null) {
                $temu = TemuanModel::where('tanggal','LIKE', '%'.$cari.'%')
                    ->orderBy('tanggal', 'DESC')
                        ->paginate(15);
                    $temu->appends(['date' => $cari]);

$user = TemuanModel::with('site')->first();
                return view('temuan.index', compact('temu','cari','user'));
                } else {

$user = TemuanModel::with('site')->first();
                $temu = TemuanModel::latest()
                ->paginate(15);

                return view('temuan.index', compact('temu','user'));

        }
    }

    }

    public function tambah()
    {
        $site = SiteModel::all();

       return view('temuan.input', ['site' => $site]);
    }

    public function detil($id)
    {
        $detil = TemuanModel::findOrFail($id);

       return view('temuan.detil', compact('detil'));
    }

    public function simpan(Request $request)
    {
       $simpan = new TemuanModel;

       $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'TPL-'.$th.$month.'-';
        $nolap = Helper::IDGenerator($simpan, 'no_lap', 4, $string); /** Generate id */

    $files = $request->file('images');
        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/temuan/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
          $gambar_dok = implode('|', $image);
        }

       $simpan->no_lap = $nolap;
       $simpan->pelapor = Auth::user()->name;
       $simpan->tanggal = $request->tanggal;
       $simpan->jam = $request->jam;
       $simpan->lokasi = $request->lokasi;
       $simpan->area = $request->area;
       $simpan->jenis_bahaya = $request->jenis_bahaya;
       $simpan->potensi_bahaya = $request->potensi_bahaya;
       $simpan->pengendalian = $request->pengendalian;
       $simpan->foto = $gambar_dok;

       $simpan->save();

       return back()
       ->with('success', $simpan->id);
    }

    public function update(Request $request, $id)
    { 
       $update = TemuanModel::findOrFail($id);

$files = $request->file('images');

    $files = $request->file('images');
        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/temuan/'.$update->no_lap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }

            if ($update->foto == null) {
                $gambar_dok = implode('|', $image);
            } else {
                $gambar_dok = $update->foto.'|'.implode('|', $image);
            }

       $update->tanggal = $request->tanggal;
       $update->jam = $request->jam;
       $update->lokasi = $request->lokasi_kejadian;
       $update->area = $request->area;
       $update->jenis_bahaya = $request->jenis_bahaya;
       $update->potensi_bahaya = $request->potensi_bahaya;
       $update->pengendalian = $request->pengendalian;
       $update->foto = $gambar_dok;
       $update->save();
       
        } else {

       $update->tanggal = $request->tanggal;
       $update->jam = $request->jam;
       $update->lokasi = $request->lokasi_kejadian;
       $update->area = $request->area;
       $update->jenis_bahaya = $request->jenis_bahaya;
       $update->potensi_bahaya = $request->potensi_bahaya;
       $update->pengendalian = $request->pengendalian;
       $update->save(); 
        }

       return redirect('temuan-detil/'.$update->id)
       ->with('berhasil', 'Laporan Temuan Berhasil Diperbarui');
    }
    public function status($id)
    {
        $status = TemuanModel::findOrFail($id);

        if ($status->status == "Open"){

            $status->status = "Resolved";
            $status->save();
        
        return back()
        ->with('berhasil', 'Status Berubah');

        } else {

            $status->status = "Open";
            $status->save();
        
        return back()
        ->with('berhasil', 'Status Berubah');

        }
    }
    public function edit($id)
    {
        $edit = TemuanModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $edit->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $edit->site->id)->get(['id', 'nama_gd']);

        return view('temuan.edit', compact('edit','id','site'));
    }


    public function hapus($id)
    {
        $hapus = TemuanModel::findOrFail($id);
        $nolap = $hapus->no_lap;

        if ($hapus->foto == null){
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
        } else {
            $del = File::deleteDirectory(public_path('storage/temuan/'.$nolap));
       
       if ($del == true) {
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
       } else {
         $message = "Hapus data gagal !!!";
       } 
   }
       return back()
       ->with('berhasil', $message);
    }

public function temuanPDF($id)
    {   
        $detil = TemuanModel::with('site')->findOrFail($id);
        
        $pdf = PDF::loadView('temuan.savepdf', compact('detil'));

        return $pdf->stream('Laporan Temuan '.$detil->no_lap.'.pdf');
    }

    public function hapusFoto($item, $id)
    {
        $foto = TemuanModel::findOrFail($id);
        $del = explode('|',$foto->foto);
        $items = $del;

        $imagesToRemove = [$item];
        $poto = [];

        $collection = collect($items)->reject(function ($value) use ($imagesToRemove) {
            return in_array($value, $imagesToRemove);
        });

            foreach ($collection as $file) {
            $image_name = $file;
            $poto[] = $image_name;
            }

        $dele = File::delete(public_path('storage/temuan/'.$foto->no_lap.'/'.$item));

        if ($dele == true) {
        $foto->foto = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('berhasil','Hapus Foto Berhasil');
    }
}