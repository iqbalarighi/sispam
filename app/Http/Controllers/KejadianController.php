<?php

namespace App\Http\Controllers;

use App\Exports\KejadianExport;
use App\Helpers\Helper;
use App\Models\KejadianModel;
use App\Models\OtorisasiModel;
use App\Models\SiteModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class KejadianController extends Controller
{
    public function index(Request $request)
    {

        $cari = $request->date;
        $start =$request->start;
        $end = $request->end;
        $gd = Auth::user()->lokasi_tugas;
        $user = Auth::user()->role;

            if (Auth::user()->level == 'koordinator') {
                if ($gd == '13') {
                    if ($start != null){
                $data = KejadianModel::with('site')
                    ->whereBetween('waktu_kejadian', [$start, $end])
                    ->where('lokasi_kejadian','=', $gd)
                    ->orwhere(function ($query) use ($start , $end){
                        $query->whereIn('lokasi_kejadian', ['14','15','1','3','4','5','6','7','8','9','10'])
                            ->whereBetween('waktu_kejadian', [$start, $end]);
                    })
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                 $data = KejadianModel::with('site')
                         ->where('lokasi_kejadian', '=', $gd)
                         ->orwhere('lokasi_kejadian', '=', '14')
                         ->orwhere('lokasi_kejadian', '=', '15')
                         ->orwhere('lokasi_kejadian', '=', '1')
                         ->orwhere('lokasi_kejadian', '=', '3')
                         ->orwhere('lokasi_kejadian', '=', '4')
                         ->orwhere('lokasi_kejadian', '=', '5')
                         ->orwhere('lokasi_kejadian', '=', '6')
                         ->orwhere('lokasi_kejadian', '=', '7')
                         ->orwhere('lokasi_kejadian', '=', '8')
                         ->orwhere('lokasi_kejadian', '=', '9')
                         ->orwhere('lokasi_kejadian', '=', '10')
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                     }
                } elseif ($gd == '11') {
                    if ($start != null){
                        $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orwhere(function ($query) use ($start , $end){
                                $query->where('lokasi_kejadian', '=', '16')
                                ->where('user_pelapor','=', 'Rizal Kurnia')
                                ->whereBetween('waktu_kejadian', [$start, $end]);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                 $data = KejadianModel::with('site')
                         ->where('lokasi_kejadian', '=', $gd)
                         ->orwhere([['lokasi_kejadian', '=', '16'],['user_pelapor','=','Rizal Kurnia']])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                    }
                } elseif ($gd == '2') {
                    if ($start != null){
                $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orwhere(function ($query) use ($start , $end){
                                $query->where('lokasi_kejadian', '=', '16')
                                ->where('user_pelapor','=', 'Andri Triana')
                                ->whereBetween('waktu_kejadian', [$start, $end]);
                            })
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                 $data = KejadianModel::with('site')
                         ->where('lokasi_kejadian', '=', $gd)
                         ->orwhere([['lokasi_kejadian', '=', '16'],['user_pelapor','=','Andri Triana']])
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                    }
                } else {
                    if ($start != null){
                $data = KejadianModel::with('site')
                            ->whereBetween('waktu_kejadian', [$start, $end])
                            ->where('lokasi_kejadian','=', $gd)
                            ->orderBy('created_at', 'DESC')
                            ->paginate(100000);

                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                 $data = KejadianModel::with('site')
                         ->where('lokasi_kejadian', '=', $gd)
                        ->orderBy('created_at', 'DESC')
                        ->paginate(15); 
                }
            }
        } elseif ($user == 'admin') {
                if ($start != null){
                $data = KejadianModel::with('site')
                    ->whereBetween('waktu_kejadian', [$start, $end])
                    ->orderBy('created_at', 'DESC')
                    ->paginate(100000);
                    $data->appends(['start' => $start, 'end' => $end]);
                } else {
                    $data = KejadianModel::with('site')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
                }
        } else {
            if ($cari != null) {

        $data = KejadianModel::with('site')
                ->where([['user_pelapor','=', Auth::user()->name],['waktu_kejadian','LIKE', '%'.$cari.'%']])
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            $data->appends(['date' => $cari]);

        } else {
            if (Auth::user()->unit_kerja == "Health, Safety, & Environment" && Auth::user()->name == 'M. Arizal Kurnia'){
                $data = KejadianModel::with('site')
                ->where('user_pelapor','LIKE', '%'.'rizal Kurnia'.'%')
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            } else {
                $data = KejadianModel::with('site')
                ->where('user_pelapor','=', Auth::user()->name)
                ->orderBy('created_at', 'DESC')
                ->paginate(15);
            }


        }
    }

        return View('kejadian.index', compact('data','start','end','cari'));
    }    

    // Lanjut filtering per level Admin, Kordinarot dan Danru

    public function tambah()
    {
        $site = SiteModel::all();
        return View('kejadian.input', ['site' => $site]);
    }

    public function simpan(Request $nilai)
    { 
     $files = $nilai->file('images');

     if ($files != null){  
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
}

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'LAP-'.$th.$month.'-';
        $nolap = Helper::IDGenerator(new KejadianModel, 'no_lap', 4, $string); /** Generate id */

        $jadi = new KejadianModel(); 
        $jam = Carbon::parse($nilai->jam_kejadian)->isoformat('HH:mm');
        
        $image = [];

// ======================sebab dasar================================
        $dasar = $nilai->sebab_dasar;
        if (in_array('Lain-lain :', $dasar) != null) {
            $xx = array_slice($nilai->sebab_dasar,-2,1);
            $yy = end($dasar);
            $xxx = implode('', $xx);

            $hasil = $xxx.' '.$yy;
       

        $items = $dasar;
        $sebtoremove = [$xxx,$yy];
        $seb = [];
        $collection = collect($items)->reject(function ($value) use ($sebtoremove) {
            return in_array($value, $sebtoremove);
        });

            foreach ($collection as $file) {
            $seb_name = $file;
            $seb[] = $seb_name;
            } 

        if (empty($seb)) {
           $res_dasar = $hasil;
           } else {
            $res_dasar = implode('|', $seb).'|'.$hasil;
           }

        } else{
            foreach ($nilai->sebab_dasar as $key => $valu) {
            $sebab[] = $valu;
        }

        $res_dasar = implode('|', $sebab);
        }

// =====================Sebab tindakan==================================
        $tindak = $nilai->sebab_tindakan;
        if (in_array('Lain-lain :', $tindak) != null) {
            $aa = array_slice($nilai->sebab_tindakan,-2,1);
            $bb = end($tindak);
            $cc = implode('', $aa);
            
            $tindaks = $cc.' '.$bb;

        $item_2 = $tindak;
        $remove_tind = [$cc,$bb];
        $tinds = [];
        $collect = collect($item_2)->reject(function ($value1) use ($remove_tind) {
            return in_array($value1, $remove_tind);
        });

            foreach ($collect as $file2) {
            $tin_dak = $file2;
            $tinds[] = $tin_dak;
       }

       if (empty($tinds)) {
           $res_tindak = $tindaks;
       } else {
        $res_tindak = implode('|', $tinds).'|'.$tindaks;
       }
        
        } else {
             foreach ($nilai->sebab_tindakan as $key => $value) {
                $tindakan[] = $value;
        }
            $res_tindak = implode('|', $tindakan);
        }

// ========================sebab kondisi===============================
        $kondisi = $nilai->sebab_kondisi;
        if (in_array('Lain-lain :', $kondisi) != null) {
            $aa = array_slice($nilai->sebab_kondisi,-2,1);
            $bb = end($kondisi);
            $cc = implode('', $aa);
            
            $konds = $cc.' '.$bb;

        $item_3 = $kondisi;
        $remove_kond = [$cc,$bb];
        $kondis = [];
        $collects = collect($item_3)->reject(function ($value2) use ($remove_kond) {
            return in_array($value2, $remove_kond);
        });

            foreach ($collects as $file3) {
            $kond_isi = $file3;
            $kondis[] = $kond_isi;
       }
 
       if (empty($kondis)) {
           $res_kondisi = $konds;
       } else {
        $res_kondisi = implode('|', $kondis).'|'.$konds;
       }
        
        } else {
            foreach ($nilai->sebab_kondisi as $key => $val) {
            $kond[] = $val;
        }
            $res_kondisi = implode('|', $kond);
        }

// ===============jenis potensi===============================
        $potensi = $nilai->jenis_potensi;
    if (is_array($nilai->jenis_potensi)) {
        $pot_ens = array_slice($nilai->jenis_potensi,-2,1);
        $pot = implode('', $pot_ens);
        $bbs = end($potensi);
        $potens = $pot.' '.$bbs;
    } else {
       $potens = $nilai->jenis_potensi;
    }

    // ===============jenis kejadian===============================
        $jadian = $nilai->jenis_kejadian;
    if (is_array($nilai->jenis_kejadian)) {
        $dian = array_slice($nilai->jenis_kejadian,-2,1);
        $keja = implode('', $dian);
        $abc = end($jadian);
        $kejadian = $keja.' '.$abc;
    } else {
       $kejadian = $nilai->jenis_kejadian;
    }

// =======================================================

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/kejadian/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
          $gambar_dok = implode('|', $image);
        } else {
            $gambar_dok = NULL;
        }

        $jadi->no_lap = $nolap;
        $jadi->jenis_kejadian = $kejadian;
        $jadi->user_pelapor = Auth::user()->name;
        $jadi->lokasi_kejadian = $nilai->lokasi_kejadian;
        $jadi->waktu_kejadian = $nilai->waktu_kejadian;
        $jadi->jam_kejadian = $jam;
        $jadi->jenis_potensi = $potens;
        $jadi->penyebab = $nilai->penyebab;
        $jadi->saksi_mata = $nilai->saksi_mata;
        $jadi->korban = $nilai->korban;
        $jadi->kerugian = $nilai->kerugian;
        $jadi->uraian_singkat = $nilai->uraian_singkat;
        $jadi->tindak_perbaikan = $nilai->tindak_perbaikan;
    $jadi->sebab_dasar = $res_dasar;
    $jadi->sebab_tindakan = $res_tindak;
    $jadi->sebab_kondisi = $res_kondisi;
        $jadi->rencana_perbaikan = $nilai->rencana_perbaikan;
        $jadi->kom_mng_rep = $nilai->kom_mng_rep;
        $jadi->nama_pelapor = $nilai->nama_pelapor;
        $jadi->uker_pelapor = $nilai->uker_pelapor;
        $jadi->dokumentasi = $gambar_dok;
    $jadi->jenis_potensi = $potens;
        $jadi->save();

        return back()
            ->with('berhasil', $nolap);
    }

    public function detil($id)
    {
        $detil = KejadianModel::with('site')->where('no_lap', '=', $id)->first();
        $otor = OtorisasiModel::all();
        $validator = User::where('unit_kerja', 'Security Monitoring Center')->orwhere('unit_kerja', 'Health, Safety, & Environment')->get();

        $otorized = $otor->where('nama', Auth::user()->name)->first();
        return view('kejadian.detil', compact('detil','otor', 'otorized', 'validator'));
    }

    public function edit($id)
    {
        $edit = KejadianModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $edit->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $edit->site->id)->get(['id', 'nama_gd']);

        return view('kejadian.edit', [
            'edit'=> $edit,
            'id'=>$id,
            'site'=>$site,
            'dasar'=> explode('|', $edit->sebab_dasar),
            'tindak'=> explode('|', $edit->sebab_tindakan),
            'kondisi'=> explode('|', $edit->sebab_kondisi)
        ]);
    }

public function kejadianPDF($id, $oto, $val)
    {   
        $detil = KejadianModel::with('site')->findOrFail($id);
        $otor = OtorisasiModel::findOrFail($oto);
        $valid = User::findOrFail($val);

$text = 
"Nama: ".$otor->nama."
Jabatan : ".$otor->jabatan."
NIP : ".$otor->nip."
Tanggal Otorisasi ".Carbon::parse($detil->otoritime)->isoFormat('DD/MM/YYYY HH:mm:ss');

$text2 = 
"Nama: ".$valid->name."
Unit Kerja : ".$valid->unit_kerja."
Tanggal Validasi ".Carbon::parse($detil->validatime)->isoFormat('DD/MM/YYYY HH:mm:ss');

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text));
        $qrcode2 = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text2));
        $qrcode3 = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->generate(url('/kejadianPDF/').'/'.$id.'/'.$detil->validatedby.'/'.$detil->otorizedby));

        if (Auth::user() == true) {
        $shift = Str::substr($detil->shift, 0,7);
        $pdf = PDF::loadView('kejadian.savepdf', compact('detil','qrcode','qrcode2','qrcode3','otor','valid')); 
        $pdf->render();
        $pdf->get_canvas()->get_cpdf()->setEncryption(null, null);
    } else {
        header('Refresh: 10; URL='.route('dashboard'));

        abort(403);
    }

        // return $pdf->download('Laporan Kejadian/Insiden '.$detil->no_lap.'.pdf');
        return $pdf->stream('Laporan Kejadian/Insiden '.$detil->no_lap.'.pdf');
    }

public function update(Request $update, $id)
{
    $files = $update->file('images');
    
     if ($files != null){  
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
}


    $up = KejadianModel::findOrFail($id);
    $jm = $update->jam_kejadian;
    $jam = Carbon::parse($jm)->isoformat('HH:mm');
// =====================jenis_potensi===========================
    $potensi = $update->jenis_potensi;
    if (is_array($update->jenis_potensi)) {
        $pot_ens = array_slice($update->jenis_potensi,-2,1);
        $pot = implode('', $pot_ens);
        $bbs = end($potensi);
        $potens = $pot.' '.$bbs;
    } else {
        $potens = $update->jenis_potensi;
    }
// ====================end of jenis_potensi============================

// =====================jenis_kejadian===========================
    $jadi = $update->jenis_kejadian;
    if (is_array($update->jenis_kejadian)) {
        $jadiin = array_slice($update->jenis_kejadian,-2,1);
        $jad = implode('', $jadiin);
        $cba = end($jadi);
        $kejadian = $jad.' '.$cba;
    } else {
        $kejadian = $update->jenis_kejadian;
    }
// ====================end of jenis_kejadian============================

// =====================sebab dasar==============================
    $dasar = $update->sebab_dasar;
        if (in_array('Lain-lain :', $dasar) != null) {
            $xx = array_slice($update->sebab_dasar,-2,1);
            $yy = end($dasar);
            $xxx = implode('', $xx);

            $hasil = $xxx.' '.$yy;
       
        $items = $dasar;
        $sebtoremove = [$xxx,$yy];
        $seb = [];
        $collection = collect($items)->reject(function ($value) use ($sebtoremove) {
            return in_array($value, $sebtoremove);
        });

            foreach ($collection as $file) {
            $seb_name = $file;
            $seb[] = $seb_name;
            } 

        if (empty($seb)) {
           $res_dasar = $hasil;
           } else {
            $res_dasar = implode('|', $seb).'|'.$hasil;
           }

        } else{
            foreach ($update->sebab_dasar as $key => $valu) {
            $sebab[] = $valu;
        }
        $res_dasar = implode('|', $sebab);
        }

// =====================end of sebab dasar=======================

// =====================sebab tindakan==============================
        $tindak = $update->sebab_tindakan;
        if (in_array('Lain-lain :', $tindak) != null) {
            $aa = array_slice($update->sebab_tindakan,-2,1);
            $bb = end($tindak);
            $cc = implode('', $aa);
            
            $tindaks = $cc.' '.$bb;

        $item_2 = $tindak;
        $remove_tind = [$cc,$bb];
        $tinds = [];
        $collect = collect($item_2)->reject(function ($value1) use ($remove_tind) {
            return in_array($value1, $remove_tind);
        });

            foreach ($collect as $file2) {
            $tin_dak = $file2;
            $tinds[] = $tin_dak;
       }

       if (empty($tinds)) {
           $res_tindak = $tindaks;
       } else {
        $res_tindak = implode('|', $tinds).'|'.$tindaks;
       }
        
        } else {
             foreach ($update->sebab_tindakan as $key => $value) {
                $tindakan[] = $value;
        } 
            $res_tindak = implode('|', $tindakan);
        }
// =====================end of sebab tindakan=======================

// =====================sebab kondisi==============================
        $kondisi = $update->sebab_kondisi;
        if (in_array('Lain-lain :', $kondisi) != null) {
            $aa = array_slice($update->sebab_kondisi,-2,1);
            $bb = end($kondisi);
            $cc = implode('', $aa);
            
            $konds = $cc.' '.$bb;

        $item_3 = $update->sebab_kondisi;
        $remove_kond = [$cc,$bb];
        $kondis = [];
        $collects = collect($item_3)->reject(function ($value2) use ($remove_kond) {
            return in_array($value2, $remove_kond);
        });

            foreach ($collects as $file3) {
            $kond_isi = $file3;
            $kondis[] = $kond_isi;
       }

       if (empty($kondis)) {
           $res_kondisi = $konds;
       } else {
        $res_kondisi = implode('|', $kondis).'|'.$konds;
       }
        
        } else {
        foreach ($update->sebab_kondisi as $key => $val) {
            $kon[] = $val;
        }
            $res_kondisi = implode('|', $kon);
        }
// =====================end of sebab kondisi=======================
       $nolap = $up->no_lap;
       
        $image = [];
        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/kejadian/'.$nolap.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }

            if ($up->dokumentasi == null) {
                $gambar_dok = implode('|', $image);
            } else {
                $gambar_dok = $up->dokumentasi.'|'.implode('|', $image);
            }

        } else {
            $gambar_dok = $up->dokumentasi;
        }
// ================================================================

        $up->jenis_kejadian = $kejadian;
        $up->lokasi_kejadian = $update->lokasi_kejadian;
        $up->waktu_kejadian = $update->waktu_kejadian;
    $up->jam_kejadian = $jam;
    $up->jenis_potensi = $potens;
        $up->penyebab = $update->penyebab;
        $up->saksi_mata = $update->saksi_mata;
        $up->korban = $update->korban;
        $up->kerugian = $update->kerugian;
        $up->uraian_singkat = $update->uraian_singkat;
    $up->sebab_dasar = $res_dasar;
    $up->sebab_tindakan = $res_tindak;
    $up->sebab_kondisi = $res_kondisi;
        $up->tindak_perbaikan = $update->tindak_perbaikan;
        $up->rencana_perbaikan = $update->rencana_perbaikan;
        $up->kom_mng_rep = $update->kom_mng_rep;
        $up->nama_pelapor = $update->nama_pelapor;
        $up->uker_pelapor = $update->uker_pelapor;
        $up->dokumentasi = $gambar_dok;
        $up->save();
    

    return back()->with('berhasil','Update Laporan Kejadian Berhasil');

}

    public function hapusFoto($item, $id)
    {
        $foto = KejadianModel::findOrFail($id);
        $del = explode('|',$foto->dokumentasi);
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

        $dele = File::delete(public_path('storage/kejadian/'.$foto->no_lap.'/'.$item));

        if ($dele == true) {
        $foto->dokumentasi = implode('|', $poto);
        $foto->save();
        }
        return back()
        ->with('berhasil','Hapus Foto Berhasil');
    }


    public function hapus($id)
    {
        $hapus = KejadianModel::findOrFail($id);
        $nolap = $hapus->no_lap;


        if ($hapus->dokumentasi == null){
            $hapus->delete();
            $message = 'No Laporan '.$nolap.' Sudah Terhapus';
        } else {
            $del = File::deleteDirectory(public_path('storage/kejadian/'.$nolap));
       
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

    public function export(Request $request, $start, $end, $count)
    {
        $start = Carbon::parse($request->start)->isoFormat('D MMMM Y');
        $end = Carbon::parse($request->end)->isoFormat('D MMMM Y');

        
        if ($start == $end) {
            return Excel::download(new KejadianExport($request->start, $request->end, $request->count), 'Laporan Kejadian '.$start.'.xlsx');  
        } else {
            return Excel::download(new KejadianExport($request->start, $request->end, $request->count), 'Laporan Kejadian '.$start.' - '.$end.'.xlsx');
        }

        
    }

    public function status($id)
    {
        $status = KejadianModel::findOrFail($id);

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

    public function validasi($id)
    {
        $validasi = KejadianModel::with('site')->where('no_lap', '=', $id)->first();
        $date = Carbon::now()->parse()->isoFormat('DD-MM-YYYY HH:mm:ss');

        $validasi->validatime = $date;
        $validasi->validatedby = Auth::user()->id;
        $validasi->save();

        return back()
        ->with('berhasil', 'Validasi Dokumen Berhasil');
    }

    public function validmin($id, $val)
    {
        $validasi = KejadianModel::with('site')->where('no_lap', '=', $id)->first();
        $date = Carbon::now()->parse()->isoFormat('DD-MM-YYYY HH:mm:ss');
        
        $validasi->validatime = $date;
        $validasi->validatedby = $val;

        $validasi->save();

        return back()
        ->with('berhasil', 'Validasi Dokumen Berhasil');
    }

    public function otorisasi($id, $oto)
    {
        $otorized = KejadianModel::with('site')->where('no_lap', '=', $id)->first();
        
        if ($otorized->validatedby == null) {
            return back()
        ->with('abort', 'Dokumen Belum di validasi');
        }
        $date = Carbon::now()->parse()->isoFormat('DD-MM-YYYY HH:mm:ss');

        $otorized->otoritime = $date;
        $otorized->otorizedby = $oto;

        $otorized->save();

        return back()
        ->with('berhasil', 'Otorisasi Dokumen Berhasil');
    }


}