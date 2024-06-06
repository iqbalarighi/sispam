<?php

namespace App\Http\Controllers;

use App\Exports\KegiatanExport;
use App\Helpers\Helper;
use App\Models\KegiatanModel;
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
// use App\Exports\MttRegistrationsExport;
use Maatwebsite\Excel\Facades\Excel;

class KegiatanController extends Controller
{
    public function index(Request $request) {
        $user = Auth::user()->role;
        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;
        $gd = Auth::user()->lokasi_tugas;

        if (Auth::user()->level == 'koordinator') {
                if ($gd == '13') {
                    if ($start != null){
                        $gg[] = null;

                $giats = kegiatanModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->where('gedung','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->whereIn('gedung', ['14','15'])
                            ->whereBetween('tanggal', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

                    $giats->appends(['start' => $start, 'end' => $end]);
                } else {
                    $gg[] = null;

                 $giats = kegiatanModel::with('site')
                         ->where('gedung', '=', $gd)
                         ->orwhere('gedung', '=', '14')
                         ->orwhere('gedung', '=', '15')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                     }
                } elseif ($gd == '11') {
                    if ($start != null){
                        $gg[] = null;

                        $giats = kegiatanModel::with('site')
                            ->whereBetween('tanggal', [$start, $end])
                            ->where('gedung','=', $gd)
                            ->orwhere(function ($query) use ($start , $end){
                                $query->where('gedung', '=', '16')
                                ->where('danru','LIKE','%'.'Rizal Kurnia'.'%')
                                ->whereBetween('tanggal', [$start, $end]);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $giats->appends(['start' => $start, 'end' => $end]);
                } else {
                    $gg[] = null;
                 $giats = kegiatanModel::with('site')
                         ->where('gedung', '=', $gd)
                         ->orwhere([['gedung', '=', '16'],['danru','LIKE','%'.'Rizal Kurnia'.'%']])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                    }
                } elseif ($gd == '2') {
                    if ($start != null){
                        $gg[] = null;
                    $giats = kegiatanModel::with('site')
                                ->whereBetween('tanggal', [$start, $end])
                                ->where('gedung','=', $gd)
                                ->orwhere(function ($query) use ($start , $end){
                                    $query->where('gedung', '=', '16')
                                    ->where('danru','=', 'Andri Triana')
                                    ->whereBetween('tanggal', [$start, $end]);
                                })
                                ->orderBy('created_at', 'DESC')
                                ->paginate(100000);

                        $giats->appends(['start' => $start, 'end' => $end]);
                    } else {
                        $gg[] = null;
                     $giats = kegiatanModel::with('site')
                             ->where('gedung', '=', $gd)
                             ->orwhere([['gedung', '=', '16'],['danru','=','Andri Triana']])
                            ->orderBy('created_at', 'DESC')
                            ->paginate(15); 
                    }
                } else {
                    if ($start != null){
                        $gg[] = null;

                $giats = kegiatanModel::with('site')
                            ->whereBetween('tanggal', [$start, $end])
                            ->where('gedung','=', $gd)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $giats->appends(['start' => $start, 'end' => $end]);
                } else {
                    $gg[] = null;

                 $giats = kegiatanModel::with('site')
                         ->where('gedung', '=', $gd)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                }
            }
        } elseif ($user == 'admin') {
                if ($start != null){
                $giats = kegiatanModel::with('site')
                    ->whereBetween('tanggal', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $giats->appends(['start' => $start, 'end' => $end]);

                foreach (kegiatanModel::whereBetween('tanggal', [$start, $end])->latest()->get() as $gatt) {
                    if(str_contains(strtolower($gatt->giat), 'audiensi')){
                        $gg[] = $gatt->no_lap;
                    }
                }

                } else {
                    $giats = kegiatanModel::with('site')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);


                foreach (kegiatanModel::latest()->get() as $gatt) {
                    if(str_contains(strtolower($gatt->giat), 'audiensi')){
                        $gg[] = $gatt->no_lap;
                    }
                }

                }
        } else {
            if ($cari != null) {
$gg[] = null;

        $giats = kegiatanModel::with('site')
                ->where([['danru','=', Auth::user()->name],['tanggal','LIKE', '%'.$cari.'%']])
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            $giats->appends(['date' => $cari]);

        } else {

$gg[] = null;

            if (Auth::user()->unit_kerja == "Health, Safety, & Environment" && Auth::user()->name == 'M. Arizal Kurnia'){
                $giats = kegiatanModel::with('site')
                ->where('danru','LIKE', '%'.'rizal Kurnia'.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            } else {
                $gg[] = null;

        $giats = kegiatanModel::with('site')
        ->where('danru','LIKE', '%'.Auth::user()->name.'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(15);
                // dd($giats);
            }

        }
    }

        return view('kegiatan.index', compact('giats', 'start', 'end', 'cari', 'gg'));

    }

    public function tambah()
    {
        $site = SiteModel::get();

         return view('kegiatan.input', ['site' => $site]);
    }


    public function simpan(Request $request)
    {
//start of validator
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
//end fo validator
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);

        $string = 'PAM-'.$th.$month.'-';

        $nolap = Helper::IDGenerator(new KegiatanModel, 'no_lap', 4, $string); /** Generate id */

        $files = $request->file('images');

        $image = [];

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/kegiatan/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
        }

            $simpan = new kegiatanModel();
            $simpan->no_lap = $nolap;
            $simpan->tanggal = $request->tgl;
            $simpan->gedung = $request->gedung;
            $simpan->personil = $request->personil;
            $simpan->danru = Auth::user()->name;
            $simpan->trc = $request->trc;
            $simpan->giat = $request->giat;
            $simpan->keterangan = $request->ket;
            $simpan->foto = implode('|', $image);
            $simpan->save();

            return back()
            ->with('success', $simpan->id);


    }

    public function detil($id)
    {
        $detil = kegiatanModel::with('site')->findOrFail($id);
        
       return view('kegiatan.detil',['detil' => $detil]);
    }

    public function hapus($id)
    {
        $hapus = kegiatanModel::findOrFail($id);
        $nolap = $hapus->no_lap;

       $del = File::deleteDirectory(public_path('storage/kegiatan/'.$nolap));

       if ($del == true) {
            $hapus->delete();
       }
       return back()
       ->with('sukses','No Laporan '.$nolap.' Sudah Terhapus');
    }

    public function edit(Request $request, $id)
    {
        $edit = kegiatanModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $edit->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $edit->site->id)->get(['id', 'nama_gd']);
        return view('kegiatan.edit', ['edit' => $edit, "site" => $site, "id" => $id]);
    }

public function update(Request $request, $id)
    {   
        $update = kegiatanModel::findOrFail($id);
        $files = $request->file('images');



        if ($update->personil == $request->personil) {

            if ($update->trc == $request->trc) {

                if ($update->giat == $request->giat) {

                   if ($update->keterangan == $request->ket) {

                        if ($update->tanggal == $request->tgl) {

                            if ($update->gedung == $request->gedung) {

                                if ($files == null) {
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
                                                ->with('warning','Tidak ada perubahan yang di simpan !');
                                        }

                                    return back()
                                    ->with('warning','Tidak ada perubahan yang di simpan');
                                }
                            }
                        }
                    }
                }
            }
        } 
        
//array validator
 if ($files != null) {
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
} //array validator

        $nolap = $request->nolap;
        $image = [];
        $poto = [];
        if ($files != null) {
            foreach ($files as $file) {
            $image_name = md5(rand(100, 1000));
            $ext = strtolower($file->getClientOriginalExtension());
            $image_full_name = $image_name.'.'.$ext;
            $image_path = public_path('storage/kegiatan/'.$nolap.'/');
            $image_url = $image_path.$image_full_name;
            $file->move($image_path, $image_full_name);
            $image[] = $image_full_name;
            } 

            if ($update->foto == null) {
                $tambah = implode('|', $image);
            } else {
                $tambah = $update->foto.'|'.implode('|', $image);
            }
            

            $update->no_lap = $nolap;
            $update->tanggal = $request->tgl;
            $update->gedung = $request->gedung;
            $update->personil = $request->personil;
            $update->trc = $request->trc;
            $update->giat = $request->giat;
            $update->keterangan = $request->ket;
            $update->foto = $tambah;
            $update->save();
           
        } else {

            $update->tanggal = $request->tgl;
            $update->gedung = $request->gedung;
            $update->personil = $request->personil;
            $update->trc = $request->trc;
            $update->giat = $request->giat;
            $update->keterangan = $request->ket;
            $update->save();
        }
            return back()
            ->with('success', 'Update Laporan Kegiatan Berhasil !')
            ->with('id', $id);
    }

    public function hapusFoto($item, $id)
    {
        $foto = kegiatanModel::findOrFail($id);
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

        $dele = File::delete(public_path('storage/kegiatan/'.$foto->no_lap.'/'.$item));

        if ($dele == true) {
        $foto->foto = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('success','Hapus Foto Berhasil')
        ->with('id', $id);
    }

public function downloadPDF($id)
    {   
        $detil = kegiatanModel::with('site')->findOrFail($id);
        
        $pdf = PDF::loadView('kegiatan.savepdf', ['detil' => $detil]);

        return $pdf->stream('Laporan Kegiatan '.$detil->no_lap.'.pdf');
    }

// public function export() 
// {

//     return Excel::download(new KegiatanExport, 'kegiatan.xlsx'); 
// }

public function export(Request $request, $start, $end)
    {
        $start = Carbon::parse($request->start)->isoFormat('D MMMM Y');
        $end = Carbon::parse($request->end)->isoFormat('D MMMM Y');

        if ($start == $end) {

          return Excel::download(new KegiatanExport($request->start, $request->end), 'Laporan Kegiatan '.$start.'.xlsx');  

        } else {
            return Excel::download(new KegiatanExport($request->start, $request->end), 'Laporan Kegiatan '.$start.' - '.$end.'.xlsx');
        }

        
    }

}

