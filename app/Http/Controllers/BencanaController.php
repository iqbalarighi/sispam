<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use Illuminate\Support\Facades\Auth;
use App\Models\BencanaModel;
use App\Models\SiteModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use PDF;

class BencanaController extends Controller
{
    public function index(Request $request)
    {
        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;

        if (Auth::user()->role == 'admin'){
            if ($start != null) {
               $bencana = BencanaModel::with('site')
               ->whereBetween('tanggal', [$start, $end])
               ->orderBy('tanggal', 'DESC')
               ->paginate(15);

               $bencana->appends(compact('bencana','start','end','cari'));
               
               return view('bencana.index', compact('bencana','start','end','cari'));
            } else {
                           $bencana = BencanaModel::with('site')->paginate(15);

         return view('bencana.index', compact('bencana','start','end','cari'));
            }
        } else {
            if ($cari != null) {
                $bencana = BencanaModel::where('tanggal','LIKE', '%'.$cari.'%')
                    ->orderBy('tanggal', 'DESC')
                    ->orderBy('tanggal', 'DESC')
                        ->paginate(15);
                    $bencana->appends(['date' => $cari]);
                return view('bencana.index', compact('bencana','cari'));

                } else {

                $bencana = BencanaModel::orderBy('tanggal', 'DESC')
                ->orderBy('tanggal', 'DESC')
                ->paginate(15);

                return view('bencana.index', compact('bencana'));

        }
    }

       
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

        $loka = $request->gedung;

        foreach ($loka as $lok) {
            $hasil[] = $lok;
        }

        $lokasi = implode('|', $hasil);

// dd($lokasi);

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
        $bencana->lokasi = $lokasi;
        $bencana->jenis_bencana = $bncna;
        $bencana->nama_pelapor = $request->pelapor;
        $bencana->satker = $request->satker;
        $bencana->kejadian_bencana = $request->kejadian_bencana;
        $bencana->kronologi_bencana = $request->kronologi_bencana;
        $bencana->penanganan = $request->penanganan;
        $bencana->foto = $gambar_dok;
        $bencana->save();

        return redirect('bencana')
        ->with('sukses', 'Laporan Berhasil Dibuat.');
    }


    public function edit(Request $request, $id)
{
        $edit = BencanaModel::with('site')->findOrFail($id);

        foreach (explode('|', $edit->lokasi) as $value) {

            $sites = SiteModel::where('id', '=', $value)
                    ->first();

 $datax[] = (object) ['id' => $sites['id'], 'text' =>$sites['nama_gd']];

        }
$data = collect($datax);
// dd($data);
            // if($request->ajax()){

            //    return response()->json($data);
            // }

        // $id = SiteModel::where('id', '=', $edit->site->id)->get(['id']);
        // $site = SiteModel::where('id', '!=', $edit->site->id)->get(['id', 'nama_gd']);

        return view('bencana.edit', ['edit' => $edit, 'data'=>$data]);
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

    public function update(Request $request, $id)
    {    $update = BencanaModel::findOrFail($id);

$files = $request->file('images');

        $bncn = $request->jenis_bencana;
        if (is_array($request->jenis_bencana)) {
            $dian = array_slice($request->jenis_bencana,-2,1);
            $keja = implode('', $dian);
            $abc = end($bncn);
            $bncna = $keja.' '.$abc;
        } else {
           $bncna = $request->jenis_bencana;
        }

        if ($files != null) {
            foreach ($files as $file) {
            $image_name = md5(rand(100, 1000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $image_path = public_path('storage/bencana/'.$update->no_bencana.'/');
            $image_url = $image_path.$image_full_name;
            $file->move($image_path, $image_full_name);
            $image[] = $image_full_name;
            } 

            if ($update->foto == null) {
                $gambar_dok = implode('|', $image);
            } else {
                $gambar_dok = $update->foto.'|'.implode('|', $image);
            }

        $update->tanggal = $request->tgl;
        $update->lokasi = $request->gedung;
        $update->jenis_bencana = $bncna;
        $update->nama_pelapor = $request->pelapor;
        $update->satker = $request->satker;
        $update->kejadian_bencana = $request->kejadian_bencana;
        $update->kronologi_bencana = $request->kronologi_bencana;
        $update->penanganan = $request->penanganan;
        $update->foto = $gambar_dok;
        $update->save();

    } else {

        $update->tanggal = $request->tgl;
        $update->lokasi = $request->gedung;
        $update->jenis_bencana = $bncna;
        $update->nama_pelapor = $request->pelapor;
        $update->satker = $request->satker;
        $update->kejadian_bencana = $request->kejadian_bencana;
        $update->kronologi_bencana = $request->kronologi_bencana;
        $update->penanganan = $request->penanganan;
        $update->save();
    }
        return back()
        ->with('success', 'Laporan Berhasil di Update');
    }

public function savePDF($id)
    {   
        $detil = BencanaModel::with('site')->findOrFail($id);
        
        $pdf = PDF::loadView('bencana.savepdf', ['detil' => $detil]);

        return $pdf->stream('Laporan Bencana '.$detil->no_bencana.'.pdf');
    }

    public function status($id)
    {
        $status = BencanaModel::findOrFail($id);

        if ($status->status == "Open"){

            $status->status = "Resolved";
            $status->save();

        } else {

            $status->status = "Open";
            $status->save();
            
        }

        return back()
        ->with('sukses', 'Status Berubah');
    }

    public function hapus($id)
    {
        $hapus = BencanaModel::findOrFail($id);
        $nolap = $hapus->no_bencana;


        if ($hapus->dokumentasi == null){
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
        } else {
            $del = File::deleteDirectory(public_path('storage/bencana/'.$nolap));
       
       if ($del == true) {
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
       } else {
         $message = "Hapus data gagal !!!";
       } 
   }
       return back()
       ->with('sukses', $message);
    }

    public function select2(Request $request)
    {
        $site = SiteModel::where('nama_gd', 'LIKE', '%'.$request->get('term'). '%')
                    ->distinct()
                    ->get();

        foreach ($site as $hsl)
            {
                $dat['id'] = $hsl->id;
                $dat['lokasi'] = $hsl->nama_gd;

                $data[] = $dat;
            }

return response()->json($data);
        
    }
}
