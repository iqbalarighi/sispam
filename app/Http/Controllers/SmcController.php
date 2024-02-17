<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\SmcModel;
use App\Models\SiteModel;
use App\Services\PayUService\Exception;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class SmcController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->date;
        $start =$request->start;
        $end = $request->end;

            if ($start != null) {
               $data = SmcModel::with('site')
               ->whereBetween('tanggal', [$start, $end])
               ->orderBy('tanggal', 'DESC')
               ->paginate(15);

               $data->appends(compact('data','start','end'));
               
               return view('smc.index', compact('data','start','end'));
            }

        if ($date != null) {
            $data = SmcModel::where('tanggal','LIKE', '%'.$date.'%')
                ->orderBy('tanggal', 'DESC')
                    ->paginate(15);
                $data->appends(['date' => $date]);
            return view('smc.index', compact('data','date'));
            }

        $data  = SmcModel::with('site')->orderBy('created_at', 'DESC')->paginate(15);

        return view('smc.index', compact('data','start','date','end'));
    }

    public function tambah()
    {
         return view('smc.input');
    }


    public function simpan(Request $request)
    {
//start of validator
if ($request->file('images') == true) {
    $input = request()->all();

$validator = Validator::make($input, [
    'images' => 'required|array',
],
[
    'images.required' => 'Wajib Foto Dokumentasi',
]);

if ($validator->fails()) {
    $messages = $validator->messages();
    return back()
        ->withErrors($messages);
}

foreach($input['images'] as $image)
{
    $image = array('images' => $image);
    $imageValidator = Validator::make($image, [
         'images' => 'image|mimes:jpeg,png,jpg|max:4096', //2MB 
        ],
        [
            'images.image' => 'Foto Dokumentasi harus berupa Gambar',
            'images.mimes' => 'File yang diterima hanya format :values',
            'images.max' => 'Ukuran Foto melebihi 4096 KB (4 MB)',
        ]);

    if ($imageValidator->fails()) {
        $messages = $imageValidator->messages();
        return back()
            ->withErrors($messages);
    }
}
}
//end fo validator


        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'SMC-'.$th.$month.'-';
        $nolap = Helper::IDGenerator(new SmcModel, 'no_lap', 4, $string); /** Generate id */
        $files = $request->file('images');
        $image = [];

        $simpan = new SmcModel;

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/smc/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }

            $simpan->foto = implode('|', $image);
        } 
            
            $simpan->no_lap = $nolap;
            $simpan->tanggal = $request->tgl;
            $simpan->shift = $request->shift;
            $simpan->petugas = $request->petugas;
            $simpan->creator = Auth::user()->name;
            $simpan->giat = $request->giat;
            $simpan->keterangan = $request->ket;
            $simpan->save();

            return back()
            ->with('sukses', $simpan->id);

    }

    public function detil($id)
    {
        $detil = SmcModel::with('site')->findOrFail($id);
        
       return view('smc.detil',['detil' => $detil]);
    }

    public function edit(Request $request, $id)
    {
        $edit = SmcModel::with('site')->findOrFail($id);

        return view('smc.edit', compact('edit'));
    }

    public function update(Request $request, $id)
    {
        $update = SmcModel::findOrFail($id);
        $files = $request->file('images');

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/smc/'.$update->no_lap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }

            if ($update->foto == null) {
                $update->foto = implode('|', $image);
            } else {
                $update->foto = $update->foto.'|'.implode('|', $image);
            }

        } 

        $update->tanggal = $request->tgl;
        $update->shift = $request->shift;
        $update->petugas = $request->petugas;
        $update->giat = $request->giat;
        $update->keterangan = $request->ket;
        $update->save();

        return back()
        ->with('success', 'Update Laporan Berhasil')
        ->with('id', $id);
    }

    public function hapusFoto($item, $id)
    {
        $foto = SmcModel::findOrFail($id);
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

        $dele = File::delete(public_path('storage/smc/'.$foto->no_lap.'/'.$item));

        if ($dele == true) {
        $foto->foto = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('success','Hapus Foto Berhasil')
        ->with('id', $id);
    }

    public function hapus($id)
    {
        $hapus = SmcModel::findOrFail($id);
        $nolap = $hapus->no_lap;

        if ($hapus->foto == null){
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
        } else {

        $del = File::deleteDirectory(public_path('storage/smc/'.$nolap));
       
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


public function smcPDF($id)
    {   
        $detil = SmcModel::with('site')->findOrFail($id);
        // $qrcode = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate(url('/smcPDF/'.$detil->id)));
        
    // if ($detil->creator == Auth::user()->name || Auth::user()->level === 'superadmin') {
        
    // } else {
    //     header('Refresh: 10; URL='.route('dashboard'));

    //     abort(403);
    // }
        $shift = Str::substr($detil->shift, 0,7);
        $pdf = PDF::loadView('smc.savepdf', compact('detil')); 
        return $pdf->stream('Laporan Kegiatan '.$shift.' '.$detil->no_lap.'.pdf');
    }
}
