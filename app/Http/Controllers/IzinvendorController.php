<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;

use App\Models\IzininformasiModel;
use App\Models\IzinkeselamatanModel;
use App\Models\IzinperalatanModel;
use App\Models\IzinperlengkapanModel;
use App\Models\IzinvalidasiModel;
use App\Models\IzinvendorModel;
use App\Models\OtorisasiModel;
use App\Models\SiteModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\Facades\Image as ResizeImage;

class IzinvendorController extends Controller
{
 
 public function index(Request $request)
    {

        $cari = $request->cari;
        $start = $request->start;
        $end = $request->end;

    if ($cari != null && $start != null && $end != null){
            $index = IzinvendorModel::with('izin_informasi','izin_validasi')
            ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()])
            ->whereRelation('izin_informasi', function ($query) use ($cari, $start , $end){
                        $query->where ('pemohon', 'LIKE', '%'.$cari.'%')
                            ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()]);
                    })
            ->orwhereRelation('izin_informasi', function ($query) use ($cari, $start , $end){
                        $query->where ('perusahaan_pemohon', 'LIKE', '%'.$cari.'%')
                            ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()]);
                    })
            ->orwhere('izin_id', 'LIKE', '%'.$cari.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

            $index->appends(['start' => $start, 'end' => $end]);
        } else if ($start != null && $end != null) {
            $index = IzinvendorModel::with('izin_informasi','izin_validasi')
            ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()])
            ->paginate(25)
            ->appends(request()->input());

            $index->appends(['start' => $start, 'end' => $end]);
        } elseif ($cari != null) {
            $index = IzinvendorModel::with('izin_informasi','izin_validasi')
            ->whereRelation('izin_informasi', 'pemohon', 'LIKE', '%'.$cari.'%')
            ->orwhereRelation('izin_informasi', 'perusahaan_pemohon', 'LIKE', '%'.$cari.'%')
            ->orwhere('izin_id', 'LIKE', '%'.$cari.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(25);

        $index->appends(['start' => $start, 'end' => $end]);

        } else {
            $index = IzinvendorModel::with('izin_informasi','izin_validasi')->orderBy('created_at', 'DESC')->paginate(25);
            }

        $valid = IzinvalidasiModel::all();
        return view('pekerjaan.index', compact('index','valid','cari','start','end'));
    }
// public function form()
// {
//     $site = SiteModel::get();

//     return view('pekerjaan.form', compact('site'));

// }



    public function store(Request $request)
    {
        // dd($request->file('images'));

        $izin = new IzinvendorModel;

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $string = 'SIPR-'.$th.$month.'-';
        $izin_id = Helper::IDGenerator($izin, 'izin_id', 4, $string); /** Generate id */
        /** $nodok = Helper::IDGenerator($izin, 'no_dok', 4,"");  Generate id */

// ---------------------klasifikasi---------------------------------------------------------

        $ven = $request->klasifikasi;

        if (in_array('Lain-lain :', $ven) != null) {
            $xx = array_slice($ven,-2,1);
            $yy = end($ven);
            $xxx = implode($xx);

            $hasil = $xxx.' '.$yy;

        $items = $ven;
        $zintoremove = [$xxx,$yy];
        $zin = [];
        $collection = collect($items)->reject(function ($value) use ($zintoremove) {
            return in_array($value, $zintoremove);
        });

            foreach ($collection as $file) {
            $seb_name = $file;
            $zin[] = $seb_name;
            } 

        if (empty($zin)) {
           $klas = $hasil;
           } else {
            $klas = implode(',', $zin).','.$hasil;
           }

        } else{
            foreach ($request->klasifikasi as $key => $valu) {
            $klasif[] = $valu;
        }

        $klas = implode(',', $klasif);
        }

        $izin->izin_id = $izin_id;
        $izin->klasifikasi = $klas;
        $izin->biaya = $request->biaya;
        $izin->risiko = $request->risiko;
        
// -----------------------------------------------------------------------------------------

// ---------------------------------Informasi-----------------------------------------------
    //start of validator
    // $input = request()->all();

    // $validator = Validator::make($input, [
    //     'images' => 'required|array',
    // ],
    // [
    //     'images.required' => 'Wajib Foto Dokumentasi',
    // ]);

    // if ($validator->fails()) {
    //     $messages = $validator->messages();
    //     return back()
    //         ->withErrors($messages);
    // }

    // foreach($input['images'] as $image)
    // {
    //     $image = array('images' => $image);
    //     $imageValidator = Validator::make($image, [
    //          'images' => 'image|mimes:jpeg,png,jpg|max:4096', //2MB 
    //         ],
    //         [
    //             'images.image' => 'Foto Dokumentasi harus berupa Gambar',
    //             'images.mimes' => 'File yang diterima hanya format :values',
    //             'images.max' => 'Ukuran Foto melebihi 4096 KB (4 MB)',
    //         ]);

    //     if ($imageValidator->fails()) {
    //         $messages = $imageValidator->messages();
    //         return back()
    //             ->withErrors($messages);
    //     }
    // }
//end fo validator
    $files = $request->file('images');

        $image = [];

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/izin_kerja/'.$izin_id.'/');
                $image_url = $image_path.$image_full_name;
                $file->move($image_path, $image_full_name);
                $image[] = $image_full_name;
            }
        }

    $info = new IzininformasiModel;

        $permon = $request->perusahaan_pemohon;
    if (is_array($request->perusahaan_pemohon)) {
        $dian = array_slice($request->perusahaan_pemohon,-2,1);
        $keja = implode('', $dian);
        $abc = end($permon);
        $perusahaan = $keja.' '.$abc;
    } else {
       $perusahaan = $request->perusahaan_pemohon;
    }

    $info->izin_id = $izin_id;
    $info->perusahaan_pemohon = $perusahaan;
    $info->pekerjaan = $request->pekerjaan;
    $info->lokasi = $request->lokasi;
    $info->area = $request->area;
    $info->plant = $request->plant;
    $info->manager = $request->manager;
    $info->pemohon = $request->pemohon;
    $info->tel_pemohon = $request->tel_pemohon;
    $info->pengawas = $request->pengawas;
    $info->tel_pengawas = $request->tel_pengawas;
    $info->k3 = $request->k3;
    $info->tel_k3 = $request->tel_k3;
    $info->pekerja = $request->pekerja;
    $info->enginer = $request->enginer;
    $info->surveyor = $request->surveyor;
    $info->operator_alat = $request->operator_alat;
    $info->rigger = $request->rigger;
    $info->teknisi_elektrik = $request->teknisi_elektrik;
    $info->mekanik = $request->mekanik;
    $info->welder = $request->welder;
    $info->fitter = $request->fitter;
    $info->tukang_bangunan = $request->tukang_bangunan;
    $info->tukang_kayu = $request->tukang_kayu;
    $info->lainnya = $request->lainnya;
    $info->ktp = implode('|', $image);
// -----------------------------------------------------------------------------------------

// ----------------------Perlengkapan----------------------------------
    $lengkap = new IzinperlengkapanModel;
    $lengkap->izin_id = $izin_id;

    $asd = $request->alat;
    if (!empty(array_filter($asd))) {
        foreach ($request->alat as $key => $alat) {
            $alats[$key] = $alat;
        }
        foreach ($request->jml_alat as $key => $jml_alat) {
            $jml_alats[$key] = $jml_alat.random_int(10, 99);
        }

    $lengkap->alat = implode(",", $alats);
    $lengkap->jml_alat = implode(",", $jml_alats);

    }

    $msn = $request->mesin;
    if (!empty(array_filter($msn))) {
        foreach ($request->mesin as $key => $value) {
            $msns[$key] = $value;
        }
        foreach ($request->jml_mesin as $key => $jml_mesin) {
            $jml_msns[$key] = $jml_mesin.random_int(10, 99);
        }

    $lengkap->mesin = implode(",", $msns);
    $lengkap->jml_mesin = implode(",", $jml_msns);
    
    }
    
    $mtr = $request->material;
    if (!empty(array_filter($mtr))) {
        foreach ($request->material as $key => $value) {
            $materi[$key] = $value;
        }
        foreach ($request->jml_material as $key => $jml_material) {
            $jml_materi[$key] = $jml_material.random_int(10, 99);
        }
    $lengkap->material = implode(",", $materi);
    $lengkap->jml_material = implode(",", $jml_materi);
    }
    
    $brt = $request->alat_berat;
    if (!empty(array_filter($brt))) {
        foreach ($request->alat_berat as $key => $value) {
            $berat[$key] = $value;
        }
        foreach ($request->jml_alber as $key => $jml_alber) {
            $jml_berat[$key] = $jml_alber.random_int(10, 99);
        }
    $lengkap->alat_berat = implode(",", $berat);
    $lengkap->jml_alat_berat = implode(",", $jml_berat);

    }

// --------------------------------------------------------------------
// -----------------Keselamatan-----------------------------------------
        $slm = [];

        for ($i=0; $i <count($request->aktivitas) ; $i++) { 
            $slm[] = $izin_id;
        }

        foreach ($request->aktivitas as $key => $items) {
            $matja['izin_id'] = $slm[$key];
            $matja['aktivitas'] = $items;
            $matja['potensi_bahaya'] = $request->potensi_bahaya[$key];
            $matja['langkah_aman'] = $request->langkah_aman[$key];

        IzinkeselamatanModel::create($matja);
        } 
// --------------------------------------------------------------------
// --------------------Peralatan---------------------------------------
        $peralat = new IzinperalatanModel;

        $alt = $request->pelindung_diri;

        if (in_array('Lainnya', $alt) != null) {
            $xx = array_slice($alt,-2,1);
            $yy = end($alt);
            $xxx = implode($xx);

            $result = $xxx.' : '.$yy;

        $items = $alt;
        $alattoremove = [$xxx,$yy];
        $pld = [];
        $koleksi = collect($items)->reject(function ($value) use ($alattoremove) {
            return in_array($value, $alattoremove);
        });

            foreach ($koleksi as $file) {
            $alt_name = $file;
            $pld[] = $alt_name;
            } 

        if (empty($pld)) {
           $pelindung = $result;
           } else {
            $pelindung = implode(',', $pld).','.$result;
           }

        } else{
            foreach ($request->pelindung_diri as $key => $valu) {
            $pdiri[] = $valu;
        }

        $pelindung = implode(',', $pdiri);
        }


        $kap = $request->perlengkapan;

        if (in_array('Lainnya', $kap) != null) {
            $xx = array_slice($kap,-2,1);
            $yy = end($kap);
            $xxx = implode($xx);

            $sil = $xxx.' : '.$yy;

        $items = $kap;
        $kaptoremove = [$xxx,$yy];
        $pld = [];
        $kolek = collect($items)->reject(function ($value) use ($kaptoremove) {
            return in_array($value, $kaptoremove);
        });

            foreach ($kolek as $file) {
            $kap_name = $file;
            $pan[] = $kap_name;
            } 

        if (empty($pan)) {
           $perlengkapan = $sil;
           } else {
            $perlengkapan = implode(',', $pan).','.$sil;
           }

        } else{
            foreach ($request->perlengkapan as $key => $valu) {
            $lngkp[] = $valu;
        }

        $perlengkapan = implode(',', $lngkp);
        }


        $peralat->izin_id = $izin_id;
        $peralat->pelindung_diri = $pelindung;
        $peralat->perlengkapan = $perlengkapan;

    $validasi = new IzinvalidasiModel;

    $validasi->izin_id = $izin_id;
    $validasi->nm_pmhn_granted = $request->pemohon;
    $validasi->tgl_pmhn_granted = Carbon::now();
    $validasi->tgl_pngws_granted = Carbon::now();
    $validasi->tgl_pmrks_granted = Carbon::now();
    $validasi->nm_pmhn_denied = $request->pemohon;
    $validasi->tgl_pmhn_denied = Carbon::now();
    $validasi->tgl_pngws_denied = Carbon::now();
    $validasi->tgl_pmrks_denied = Carbon::now();


 $izin->save();
 $info->save();
 $lengkap->save();
 $peralat->save();
 $validasi->save();

$val = IzinvalidasiModel::where('izin_id', $izin_id)->first();

return back()
->with('status', 'Data berhasil Tersimpan')
->with('izinid', $izin_id)
->with('id', $val->id);
// --------------------------------------------------------------------

}


public function detail($id)
{
    $detail = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->findOrFail($id);
    $selamat = IzinkeselamatanModel::where('izin_id', $detail->izin_id)->get();
    $otor = OtorisasiModel::all();

    $otorized = $otor->where('nama', Auth::user()->name)->first();

$alt = explode(',',$detail->izin_perlengkapan->alat);
$jml_alt = explode(',',$detail->izin_perlengkapan->jml_alat);

$msn = explode(',',$detail->izin_perlengkapan->mesin);
$jml_msn = explode(',',$detail->izin_perlengkapan->jml_mesin);

$materi = explode(',',$detail->izin_perlengkapan->material);
$jml_materi = explode(',',$detail->izin_perlengkapan->jml_material);

$brt = explode(',',$detail->izin_perlengkapan->alat_berat);
$jml_brt = explode(',',$detail->izin_perlengkapan->jml_alat_berat);

$alat = array_merge_recursive(array($alt,$jml_alt));
$mesin = array_merge_recursive(array($msn,$jml_msn));
$material = array_merge_recursive(array($materi,$jml_materi));
$alat_berat = array_merge_recursive(array($brt,$jml_brt));

    return view('pekerjaan.detail', compact('detail','selamat','alat','mesin','material','alat_berat','alt','msn','materi','brt','otor','otorized'));

}

public function otorisasi($id, $otoid)
{
   // dd($id, $otoid);
   $save = IzinvendorModel::where('izin_id', $id)->first();
   $simpan = IzinvalidasiModel::where('izin_id', $id)->first();

   if($simpan->mulai_granted != null){
        $save->status = "On Progress";
    } 

    if ($simpan->mulai_denied != null) {
        $save->status = "Canceled";
    }

   $save->otorizedby = $otoid;
   $save->save();

   return back()
   ->with('sukses', 'Otorisasi berhasil');
}

    public function valid($izinid)
{
    $valid = IzinvalidasiModel::where('izin_id','=', $izinid)->first();
    $izin = IzininformasiModel::where('izin_id','=', $izinid)->first();
    if ($valid->nm_pmrks_granted != null) {
    $rese = User::where('name', '!=', $valid->nm_pmrks_granted)
            ->Where('unit_kerja', '=','Health, Safety, & Environment')
            ->get();
    } else {
        $rese = User::Where('unit_kerja', '=','Health, Safety, & Environment')
            ->get();
    }

// dd($rese);

    $user = User::where('unit_kerja', '=','Health, Safety, & Environment')->get();
    return view('pekerjaan.validasi', compact('izinid','valid','izin','user','rese'));
}

public function validasi(Request $request, $izinid)
{   

    $simpan = IzinvalidasiModel::where('izin_id', $izinid)->first();
    $status = IzinvendorModel::findOrFail($simpan->id);
    $user = Auth::user()->id;
    $berlaku = $request->berlaku;
    $waktu = $request->waktu;


    if ($waktu == "addHours") {
    $expired = Carbon::parse($request->mulai_granted)->addHours($berlaku);
    } elseif ($waktu == "addDays") {
    $expired = Carbon::parse($request->mulai_granted)->addDays($berlaku);
    } elseif ($waktu == null) {
      $expired = Carbon::parse($request->mulai_granted)->addHours(12);
    }

    // dd($expired, $waktu);


if (Carbon::now()->isoFormat('HHmmss') <= 90000){ //jam 00.00 - 09.00
    $otor = OtorisasiModel::all();
    $perusahaan = IzininformasiModel::where('izin_id', $izinid)->first();
    // dd($perusahaan->perusahaan_pemohon == 'PT. Prima Karya Sarana Sejahtera (PT. PKSS)');
    if ($perusahaan->perusahaan_pemohon == 'PT. Prima Karya Sarana Sejahtera (PT. PKSS)' || $perusahaan->perusahaan_pemohon == 'PT. Kopojeka Daya Indonesia (PT. KDI)' || $perusahaan->perusahaan_pemohon == 'PT. Swadharma Griyasatya (PT. SGRS)' || $perusahaan->perusahaan_pemohon == 'PT. Bangun Prestasi Bersama (PT. BPB)'){
         $status->otorizedby = '2';
         
         if($request->mulai_granted != null){
        $status->status = "On Progress";
    } 

    if ($request->mulai_denied != null) {
        $status->status = "Canceled";
    }
    } else {
        $status->otorizedby = '1';
        
        if($request->mulai_granted != null){
        $status->status = "On Progress";
    } 

    if ($request->mulai_denied != null) {
        $status->status = "Canceled";
    }
    }
} else {
    $status->status = "Waiting";
}

    if ($request->mulai_granted != null) {
        $simpan->mulai_granted = $request->mulai_granted;
        $simpan->sampai_granted = $expired;
        $simpan->nm_pmhn_granted = $request->nm_pmhn_granted;
        $simpan->tgl_pmhn_granted = $request->tgl_pmhn_granted;
        $simpan->nm_pmrks_granted = $request->nm_pmrks_granted;
        $simpan->tgl_pmrks_granted = $request->tgl_pmhn_granted;
        $simpan->nm_pngws_granted = "Satuan Pengamanan OJK";
        $simpan->tgl_pngws_granted = $request->tgl_pmhn_granted;
        if ($simpan->mulai_denied != null) {
            $simpan->mulai_denied = null;
            $simpan->sampai_denied = null;
            $simpan->nm_pmhn_denied = null;
            $simpan->tgl_pmhn_denied = null;
            $simpan->nm_pmrks_denied = null;
            $simpan->tgl_pmrks_denied = null;
            $simpan->nm_pngws_denied = null;
            $simpan->tgl_pngws_denied = null;
        }


    $status->validatedby = $user;
    $status->save();
    } 

    if ($request->mulai_denied != null) {
        $simpan->mulai_denied = $request->mulai_denied;
        // $simpan->sampai_denied = $request->sampai_denied;
        $simpan->nm_pmhn_denied = $request->nm_pmhn_denied;
        $simpan->tgl_pmhn_denied = $request->tgl_pmhn_denied;
        $simpan->nm_pmrks_denied = $request->nm_pmrks_denied;
        $simpan->tgl_pmrks_denied = $request->tgl_pmhn_denied;
        // $simpan->nm_pngws_denied = $request->nm_pngws_denied;
        // $simpan->tgl_pngws_denied = $request->tgl_pngws_denied;
        if ($simpan->mulai_granted != null) {
            $simpan->mulai_granted = null;
            $simpan->sampai_granted = null;
            $simpan->nm_pmhn_granted = null;
            $simpan->tgl_pmhn_granted = null;
            $simpan->nm_pmrks_granted = null;
            $simpan->tgl_pmrks_granted = null;
            $simpan->nm_pngws_granted = null;
            $simpan->tgl_pngws_granted = null;
        }
    $status->status = "Canceled";
    $status->validatedby = $user;
    $status->save();
    }


    $simpan->ket = $request->ket;

    $simpan->save();

    return back()->with('success', 'berhasil');
}

public function edit($id)
{
    
    $detail = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->findOrFail($id);
    $selamat = IzinkeselamatanModel::where('izin_id', $detail->izin_id)->get();

$alt = explode(',',$detail->izin_perlengkapan->alat);
$jml_alt = explode(',',$detail->izin_perlengkapan->jml_alat);

$msn = explode(',',$detail->izin_perlengkapan->mesin);
$jml_msn = explode(',',$detail->izin_perlengkapan->jml_mesin);

$materi = explode(',',$detail->izin_perlengkapan->material);
$jml_materi = explode(',',$detail->izin_perlengkapan->jml_material);

$brt = explode(',',$detail->izin_perlengkapan->alat_berat);
$jml_brt = explode(',',$detail->izin_perlengkapan->jml_alat_berat);

$alat = array_merge_recursive(array($alt,$jml_alt));
$mesin = array_merge_recursive(array($msn,$jml_msn));
$material = array_merge_recursive(array($materi,$jml_materi));
$alat_berat = array_merge_recursive(array($brt,$jml_brt));

foreach (explode(',', $detail->izin_peralatan->pelindung_diri) as $pd) {
    $pds[] = $pd;
}
foreach (explode(',', $detail->izin_peralatan->perlengkapan) as $lngkp) {
    $leng[] = $lngkp;
}

    return view('pekerjaan.edit', compact('detail','selamat','alat','mesin','material','alat_berat','alt','msn','materi','brt','pds','leng'));
}

public function hapus_slmt($id)
{
    $hps = IzinkeselamatanModel::findOrFail($id);

    $hps->delete();

    return back();
}

public function update_risiko(Request $request, $id)
{
   $risiko = IzinvendorModel::findOrFail($id);
   if ($request->risiko != null) {
       $risiko->risiko = $request->risiko;
   
       $risiko->save();

       return back()
       ->with('success', 'Risiko Pekerjaan Berhasil Diupdate');
   }

   if ($request->biaya) {
       $risiko->biaya = $request->biaya;

        $risiko->save();

       return back()
       ->with('success', 'Tindakan Berhasil Diupdate');
   }
   
}

public function update_klasifikasi(Request $request, $id)
{
   $klasifikasi = IzinvendorModel::findOrFail($id);

    $ven = $request->klasifikasi;

        if (in_array('Lain-lain :', $ven) != null) {
            $xx = array_slice($ven,-2,1);
            $yy = end($ven);
            $xxx = implode($xx);

            $hasil = $xxx.' '.$yy;

        $items = $ven;
        $zintoremove = [$xxx,$yy];
        $zin = [];
        $collection = collect($items)->reject(function ($value) use ($zintoremove) {
            return in_array($value, $zintoremove);
        });

            foreach ($collection as $file) {
            $seb_name = $file;
            $zin[] = $seb_name;
            } 

        if (empty($zin)) {
           $klas = $hasil;
           } else {
            $klas = implode(',', $zin).','.$hasil;
           }

        } else{
            foreach ($request->klasifikasi as $key => $valu) {
            $klasif[] = $valu;
        }

        $klas = implode(',', $klasif);
        }

    $klasifikasi->klasifikasi = $klas;
    $klasifikasi->save();

   return back()
   ->with('success', 'klasifikasi Pekerjaan Berhasil Diupdate');
}

public function update_info(Request $request, $id)
{
    $info = IzininformasiModel::findOrFail($id);

// dd($info);

    $info->pekerjaan = $request->pekerjaan;
    $info->lokasi = $request->lokasi;
    $info->area = $request->area;
    $info->plant = $request->plant;
    $info->manager = $request->manager;
    $info->pemohon = $request->pemohon;
    $info->tel_pemohon = $request->tel_pemohon;
    $info->pengawas = $request->pengawas;
    $info->tel_pengawas = $request->tel_pengawas;
    $info->k3 = $request->k3;
    $info->tel_k3 = $request->tel_k3;
    $info->perusahaan_pemohon = $request->perusahaan_pemohon;
    $info->pekerja = $request->pekerja;
    $info->enginer = $request->enginer;
    $info->surveyor = $request->surveyor;
    $info->operator_alat = $request->operator_alat;
    $info->rigger = $request->rigger;
    $info->teknisi_elektrik = $request->teknisi_elektrik;
    $info->mekanik = $request->mekanik;
    $info->welder = $request->welder;
    $info->fitter = $request->fitter;
    $info->tukang_bangunan = $request->tukang_bangunan;
    $info->tukang_kayu = $request->tukang_kayu;
    $info->lainnya = $request->lainnya;

    $info->save();

   return back()
   ->with('success', 'Informasi Pekerjaan Berhasil Diupdate');
}

public function update_perlengkapan(Request $request, $id)
{
  $lengkap = IzinperlengkapanModel::findOrFail($id);

if ($request->alat != null) {
    if (!empty(array_filter($request->alat))) {

        foreach ($request->alat as $key => $alat) {
            $alats[$key] = $alat;
        } 

        foreach ($request->jml_alat as $key => $jml_alat) {
            $jml_alats[$key] = $jml_alat.random_int(10, 99);
        }

        if ($lengkap->alat == null ) {
                $alat = implode(",", $alats);
                $jml_alat = implode(",", $jml_alats);
        } else {
            $alat = $lengkap->alat.','.implode(",", $alats);
            $jml_alat = $lengkap->jml_alat.','.implode(",", $jml_alats);
        }
    $lengkap->alat = $alat;
    $lengkap->jml_alat = $jml_alat;
    $lengkap->save();

    $msg = "Alat";
        }
}
    
if ($request->mesin != null) {
    if (!empty(array_filter($request->mesin))) {

        foreach ($request->mesin as $key => $mesin) {
            $mesins[$key] = $mesin;
        } 

        foreach ($request->jml_mesin as $key => $jml_mesing) {
            $jml_mesins[$key] = $jml_mesing.random_int(10, 99);
        }

        if ($lengkap->mesin == null ) {
                $mesin = implode(",", $mesins);
                $jml_mesin = implode(",", $jml_mesins);
        } else {
            $mesin = $lengkap->mesin.','.implode(",", $mesins);
            $jml_mesin = $lengkap->jml_mesin.','.implode(",", $jml_mesins);
        }
    $lengkap->mesin = $mesin;
    $lengkap->jml_mesin = $jml_mesin;
    $lengkap->save();

    $msg = "Mesin";
        }
}

if ($request->material != null) {
    if (!empty(array_filter($request->material))) {

        foreach ($request->material as $key => $mtr) {
            $mtrl[$key] = $mtr;
        } 

        foreach ($request->jml_material as $key => $jml_mtrl) {
            $jml_material[$key] = $jml_mtrl.random_int(10, 99);
        }

        if ($lengkap->material == null ) {
                $material = implode(",", $mtrl);
                $jml_material = implode(",", $jml_material);
        } else {
            $material = $lengkap->material.','.implode(",", $mtrl);
            $jml_material = $lengkap->jml_material.','.implode(",", $jml_material);
        }
    $lengkap->material = $material;
    $lengkap->jml_material = $jml_material;
    $lengkap->save();

    $msg = "Material";
        }
}

if ($request->alat_berat != null) {
    if (!empty(array_filter($request->alat_berat))) {

        foreach ($request->alat_berat as $key => $berat) {
            $berats[$key] = $berat;
        } 

        foreach ($request->jml_alber as $key => $jml_alat_brt) {
            $jml_alat_berat[$key] = $jml_alat_brt.random_int(10, 99);
        }

        if ($lengkap->alat_berat == null ) {
                $alat_berat = implode(",", $berats);
                $jml_alat_berat = implode(",", $jml_alat_berat);
        } else {
            $alat_berat = $lengkap->alat_berat.','.implode(",", $berats);
            $jml_alat_berat = $lengkap->jml_alat_berat.','.implode(",", $jml_alat_berat);
        }
    $lengkap->alat_berat = $alat_berat;
    $lengkap->jml_alat_berat = $jml_alat_berat;
    $lengkap->save();

    $msg = "Alat Berat";
        }
}

   return back()
   ->with('success', $msg.' Berhasil Diupdate');
}

public function update_apdk(Request $request, $id)
{
    $upapdk = IzinperalatanModel::findOrFail($id);

    $apdks = $request->pelindung_diri;

        if (in_array('Lainnya', $apdks) != null) {
            $xx = array_slice($apdks,-2,1);
            $yy = end($apdks);
            $xxx = implode($xx);

            $hasil = $xxx.' '.$yy;

        $items = $apdks;
        $apdtoremove = [$xxx,$yy];
        $appdk = [];
        $koleksi = collect($items)->reject(function ($value) use ($apdtoremove) {
            return in_array($value, $apdtoremove);
        });

            foreach ($koleksi as $file) {
            $list_apd = $file;
            $appdk[] = $list_apd;
            } 

        if (empty($appdk)) {
           $apd = $hasil;
           } else {
            $apd = implode(',', $appdk).','.$hasil;
           }

        } else{
            foreach ($request->pelindung_diri as $key => $valu) {
            $apdss[] = $valu;
        }

        $apd = implode(',', $apdss);
        }

   $apdk = $request->perlengkapan;
        if (in_array('Lainnya', $apdk) != null) {
            $aa = array_slice($apdk,-2,1);
            $bb = end($apdk);
            $cc = implode($aa);

            $result = $cc.' '.$bb;

        $item = $apdk;
        $remove = [$cc,$bb];
        $apapdk = [];
        $coleksi = collect($item)->reject(function ($value) use ($remove) {
            return in_array($value, $remove);
        });

            foreach ($coleksi as $list) {
            $list_apdk = $list;
            $apapdk[] = $list_apdk;
            } 

        if (empty($apapdk)) {
           $apk = $result;
           } else {
            $apk = implode(',', $apapdk).','.$result;
           }

        } else{
            foreach ($request->perlengkapan as $key => $valu) {
            $apks[] = $valu;
        }

        $apk = implode(',', $apks);
        }

    $upapdk->pelindung_diri = $apd;
    $upapdk->perlengkapan = $apk;
    $upapdk->save();

   return back()
   ->with('success', 'Peralatan Keselamatan Berhasil Diupdate');
}

public function hapus_alat($alat, $id, $jmlalt)
{
        $data = IzinperlengkapanModel::findOrFail($id);
        $del = explode(',',$data->alat);
        $items = $del;

        $hapusalat = [$alat];
        $alatan = [];

        $collection = collect($items)->reject(function ($value) use ($hapusalat) {
            return in_array($value, $hapusalat);
        });

            foreach ($collection as $alats) {
            $list_alat = $alats;
            $alatan[] = $list_alat;
            }

        $jml_del = explode(',',$data->jml_alat);
        $item = $jml_del;

        $hapus_jmlalt = [$jmlalt];
        $jmlalat = [];

        $colek = collect($item)->reject(function ($val) use ($hapus_jmlalt) {
            return in_array($val, $hapus_jmlalt);

        });

            foreach ($colek as $alats) {
            $list_jml_alat = $alats;
            $jmlalat[] = $list_jml_alat;
            }

        $data->alat = implode(',', $alatan);
        $data->jml_alat = implode(',', $jmlalat); 

         $data->save();

        return back()
            ->with('success', 'Hapus Alat Berhasil');
}

public function hapus_mesin($mesin, $id, $jmlmsn)
{
        $data = IzinperlengkapanModel::findOrFail($id);
        $del = explode(',',$data->mesin);
        $items = $del;

        $hapusmesin = [$mesin];
        $mesins = [];

        $collection = collect($items)->reject(function ($value) use ($hapusmesin) {
            return in_array($value, $hapusmesin);
        });

            foreach ($collection as $msn) {
            $list_mesin = $msn;
            $mesins[] = $list_mesin;
            }

        $jml_del = explode(',',$data->jml_mesin);
        $item = $jml_del;

        $hapus_jmlmsn = [$jmlmsn];
        $jml_msn = [];

        $colek = collect($item)->reject(function ($val) use ($hapus_jmlmsn) {
            return in_array($val, $hapus_jmlmsn);
        });

            foreach ($colek as $msns) {
            $list_jml_msn = $msns;
            $jml_msn[] = $list_jml_msn;
            }

        $data->mesin = implode(',', $mesins);
        $data->jml_mesin = implode(',', $jml_msn); 

         $data->save();

        return back()
            ->with('success', 'Hapus Mesin Berhasil');
}

public function hapus_material($material, $id, $jmlmtr)
{
        $data = IzinperlengkapanModel::findOrFail($id);
        $del = explode(',',$data->material);
        $items = $del;

        $hapusmaterial = [$material];
        $mtrl = [];

        $collection = collect($items)->reject(function ($value) use ($hapusmaterial) {
            return in_array($value, $hapusmaterial);
        });

            foreach ($collection as $msn) {
            $list_material = $msn;
            $mtrl[] = $list_material;
            }

        $jml_del = explode(',',$data->jml_material);
        $item = $jml_del;

        $hapus_jmlmtr = [$jmlmtr];
        $jml_mtr = [];

        $colek = collect($item)->reject(function ($val) use ($hapus_jmlmtr) {
            return in_array($val, $hapus_jmlmtr);
        });

            foreach ($colek as $mtril) {
            $list_jml_mtrl = $mtril;
            $jml_mtr[] = $list_jml_mtrl;
            }

        $data->material = implode(',', $mtrl);
        $data->jml_material = implode(',', $jml_mtr); 

         $data->save();

        return back()
            ->with('success', 'Hapus Material Berhasil');
}

public function hapus_alatberat($alber, $id, $jmlalber)
{
        $data = IzinperlengkapanModel::findOrFail($id);
        $del = explode(',',$data->alat_berat);
        $items = $del;

        $hapusalatberat = [$alber];
        $alat_berat = [];

        $collection = collect($items)->reject(function ($value) use ($hapusalatberat) {
            return in_array($value, $hapusalatberat);
        });

            foreach ($collection as $brt) {
            $list_alat_berat = $brt;
            $alat_berat[] = $list_alat_berat;
            }

        $jml_del = explode(',',$data->jml_alat_berat);
        $item = $jml_del;

        $hapus_jmlalber = [$jmlalber];
        $jml_alat_berat = [];

        $colek = collect($item)->reject(function ($val) use ($hapus_jmlalber) {
            return in_array($val, $hapus_jmlalber);
        });

            foreach ($colek as $albert) {
            $list_jml_albert = $albert;
            $jml_alat_berat[] = $list_jml_albert;
            }

        $data->alat_berat = implode(',', $alat_berat);
        $data->jml_alat_berat = implode(',', $jml_alat_berat); 

         $data->save();

        return back()
            ->with('success', 'Hapus Alat Berat Berhasil');
}

public function hapus_kslmtn($id)
{
    $slmt = IzinkeselamatanModel::findOrFail($id);

    $slmt->delete();

    return back()
        ->with('success', 'Hapus Data Berhasil');
}

public function tambahSlmt(Request $request, $izinid)
{
    $selamat = IzinkeselamatanModel::where('izin_id', $izinid)->get();
            $slm = [];
            
        for ($i=0; $i <count($request->aktivitas) ; $i++) { 
            $slm[] = $selamat[0]->izin_id;
        }

        foreach ($request->aktivitas as $key => $items) {
            $matja['izin_id'] = $slm[$key];
            $matja['aktivitas'] = $items;
            $matja['potensi_bahaya'] = $request->potensi_bahaya[$key];
            $matja['langkah_aman'] = $request->langkah_aman[$key];

        IzinkeselamatanModel::create($matja);
        } 

    return back()
        ->with('success', 'Update Keselamatan Kerja Berhasil');
}

public function hapus_apd($id, $apd)
{
    $data = IzinperalatanModel::findOrFail($id);
        $del = explode(',',$data->pelindung_diri);
        $items = $del;

        $hpusalat = [$apd];
        $pelindung_diri = [];

        $collection = collect($items)->reject(function ($value) use ($hpusalat) {
            return in_array($value, $hpusalat);
        });

            foreach ($collection as $apds) {
            $list_alat = $apds;
            $pelindung_diri[] = $list_alat;
            }

        $data->pelindung_diri = implode(',', $pelindung_diri);

         $data->save();

        return back()
            ->with('success', 'Hapus Alat Pelindung Diri Berhasil');
}

public function hapus_apk($id, $apk)
{
    $data = IzinperalatanModel::findOrFail($id);
        $del = explode(',',$data->perlengkapan);
        $items = $del;

        $hpusalat = [$apk];
        $perlengkapan = [];

        $collection = collect($items)->reject(function ($value) use ($hpusalat) {
            return in_array($value, $hpusalat);
        });

            foreach ($collection as $apds) {
            $list_alat = $apds;
            $perlengkapan[] = $list_alat;
            }

        $data->perlengkapan = implode(',', $perlengkapan);

         $data->save();

        return back()
            ->with('success', 'Hapus Perlengkapan Keselamatan Berhasil');
}

public function downloadPDF($id, $oto)
    {   
if (Auth::user()->unit_kerja != "Health, Safety, & Environment" && Auth::user()->unit_kerja != "Security Monitoring Center" && Auth::user()->role != "admin") {
    header( "refresh:5;url=/dashboard" );
    return abort(401);
}

        // dd($id);
        $detail = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->findOrFail($id);
        $selamat = IzinkeselamatanModel::where('izin_id', $detail->izin_id)->get();
        $otor = OtorisasiModel::findOrFail($oto);

if(($detail->izin_validasi->mulai_granted || $detail->izin_validasi->mulai_denied) == null){
    return back()
    ->with('abort', 'Mohon validasi terlebih dahulu!');
}

        $detail->otorizedby = $oto;
        $detail->save();

$alt = explode(',',$detail->izin_perlengkapan->alat);
$jml_alt = explode(',',$detail->izin_perlengkapan->jml_alat);

$msn = explode(',',$detail->izin_perlengkapan->mesin);
$jml_msn = explode(',',$detail->izin_perlengkapan->jml_mesin);

$materi = explode(',',$detail->izin_perlengkapan->material);
$jml_materi = explode(',',$detail->izin_perlengkapan->jml_material);

$brt = explode(',',$detail->izin_perlengkapan->alat_berat);
$jml_brt = explode(',',$detail->izin_perlengkapan->jml_alat_berat);

$alat = array_merge_recursive(array($alt,$jml_alt));
$mesin = array_merge_recursive(array($msn,$jml_msn));
$material = array_merge_recursive(array($materi,$jml_materi));
$alat_berat = array_merge_recursive(array($brt,$jml_brt));

foreach (explode(',', $detail->izin_peralatan->pelindung_diri) as $pd) {
    $pds[] = $pd;
}
foreach (explode(',', $detail->izin_peralatan->perlengkapan) as $lngkp) {
    $leng[] = $lngkp;
}

// $expired = Carbon::parse($detail->izin_validasi->mulai_granted)->addHours(12);

$text = 
"Nama: ".$otor->nama."
Jabatan : ".$otor->jabatan."
NIP : ".$otor->nip."
Tanggal Validasi ".Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status Surat: Surat Keluar";
// dd($text);
$text2 = 
"Nama: ".Auth::user()->name."
Jabatan : ".Auth::user()->unit_kerja."
Tanggal Validasi ".Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status Surat: Surat Keluar";
// dd($text2);
$qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text));
$qrcode2 = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text2));

$valid = null;

        $pdf = PDF::loadView('pekerjaan.savepdf', compact('detail','selamat','alat','mesin','material','alat_berat','alt','msn','materi','brt','pds','leng','qrcode','qrcode2','otor','valid'))->setPaper('a4', 'potrait');
        $pdf->render();
        $pdf->get_canvas()->get_cpdf()->setEncryption(null, null);

        return $pdf->stream('Surat Izin Kerja Risiko '.$detail->izin_id.'.pdf');
    }


public function downloadPDF2($id, $oto, $val)
    {   
if (Auth::user()->unit_kerja != "Health, Safety, & Environment" && Auth::user()->unit_kerja != "Security Monitoring Center" && Auth::user()->role != "admin") {
    header( "refresh:5;url=/dashboard" );
    return abort(401);
}

        // dd($id);
        $detail = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->findOrFail($id);
        $selamat = IzinkeselamatanModel::where('izin_id', $detail->izin_id)->get();
        $otor = OtorisasiModel::findOrFail($oto);
        $valid = User::findOrFail($val);

if(($detail->izin_validasi->mulai_granted || $detail->izin_validasi->mulai_denied) == null){
    return back()
    ->with('abort', 'Mohon validasi terlebih dahulu!');
}

$alt = explode(',',$detail->izin_perlengkapan->alat);
$jml_alt = explode(',',$detail->izin_perlengkapan->jml_alat);

$msn = explode(',',$detail->izin_perlengkapan->mesin);
$jml_msn = explode(',',$detail->izin_perlengkapan->jml_mesin);

$materi = explode(',',$detail->izin_perlengkapan->material);
$jml_materi = explode(',',$detail->izin_perlengkapan->jml_material);

$brt = explode(',',$detail->izin_perlengkapan->alat_berat);
$jml_brt = explode(',',$detail->izin_perlengkapan->jml_alat_berat);

$alat = array_merge_recursive(array($alt,$jml_alt));
$mesin = array_merge_recursive(array($msn,$jml_msn));
$material = array_merge_recursive(array($materi,$jml_materi));
$alat_berat = array_merge_recursive(array($brt,$jml_brt));

foreach (explode(',', $detail->izin_peralatan->pelindung_diri) as $pd) {
    $pds[] = $pd;
}
foreach (explode(',', $detail->izin_peralatan->perlengkapan) as $lngkp) {
    $leng[] = $lngkp;
}

// $expired = Carbon::parse($detail->izin_validasi->mulai_granted)->addHours(12);

$text = 
"Nama: ".$otor->nama."
Jabatan : ".$otor->jabatan."
NIP : ".$otor->nip."
Tanggal Validasi ".Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status Surat: Surat Keluar";
// dd($text);
$text2 = 
"Nama: ".$valid->name."
Jabatan : ".$valid->unit_kerja."
Tanggal Validasi ".Carbon::parse($detail->izin_validasi->mulai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".Carbon::parse($detail->izin_validasi->sampai_granted)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status Surat: Surat Keluar";
// dd($text2);
$qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text));
$qrcode2 = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text2));
        
        $pdf = PDF::loadView('pekerjaan.savepdf', compact('detail','selamat','alat','mesin','material','alat_berat','alt','msn','materi','brt','pds','leng','qrcode','qrcode2','otor','valid'));

        // $pdf->get_canvas()->get_cpdf()->setEncryption('smcojk','smcojk2020');

        return $pdf->stream('Surat Izin Kerja Risiko '.$detail->izin_id.'.pdf');
    }


    public function update_pekerjaan(Request $request)
    {   
        $update = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->where('izin_id', $request->izinid)->first();
        $notfind = "Nomor Dokumen Tidak Ditemukan";

        if ($request->izinid == null) {
            return view('pekerjaan.update_pekerjaan', compact('update'));
        } else {
        if ($update == null){
            return back()
            ->with('notfind', $notfind);
        } else {
                if ($update->status == "Done") {
                return back()
                ->with('Done', 'Pekerjaan Anda sebelumnya sudah selesai');
                } 

            if ($update->status == "Open") {
            return back()
            ->with('Open', 'Dokumen Anda belum di Validasi')
            ->with('izinid', $update->izin_id)
            ->with('id', $update->id);
            } 
        if ($update->status == "Continued") {
            return back()
            ->with('Done', 'Pekerjaan Anda sebelumnya sudah selesai');
        }

        }

        }

    return view('pekerjaan.update_pekerjaan', compact('update'));

    }

    public function update_pekerjaan2(Request $request, $izinid)
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
// dd($request->images);
        $update = IzinvendorModel::with('izin_informasi','izin_perlengkapan','izin_peralatan','izin_validasi')->where('izin_id', $request->izinid)->first();

        $files = $request->file('images');
        $image = [];

        if ($files != null) {
            foreach ($files as $file) {
                $image_name = md5(rand(100, 1000));
                $ext = strtolower($file->getClientOriginalExtension());
                $image_full_name = $image_name.'.'.$ext;
                $image_path = public_path('storage/izin_kerja/'.$izinid.'/');
                $image_url = $image_path.$image_full_name;

                !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
                $imagex = ResizeImage::make($file->getRealPath())
                ->resize(800, 600)
                ->save($image_path.$image_full_name);
   
                $image[] = $image_full_name;
            }

            $update->foto = implode('|', $image);
        } 

        $update->status = $request->status;
        $update->ket = $request->ket;

       if($request->status == "Done"){
        $update->save();
        return redirect('update_pekerjaan')
        ->with('Done', 'Status pekerjaan telah terupdate!');
       }
       if($request->status == "Continued"){
        $update->save();
        return redirect('update_pekerjaan')
        ->with('Continued', 'Status pekerjaan telah terupdate!');
       }

    }

public function hapus($izinid)
{
    $hapus = IzinvendorModel::where('izin_id', $izinid)->first();
    $hapus2 = IzininformasiModel::findOrFail($hapus->id)->delete();
    $hapus3 = IzinkeselamatanModel::where('izin_id', $izinid)->delete();
    $hapus4 = IzinperalatanModel::findOrFail($hapus->id)->delete();
    $hapus5 = IzinperlengkapanModel::findOrFail($hapus->id)->delete();
    $hapus6 = IzinvalidasiModel::findOrFail($hapus->id)->delete();

    $hapus->delete();

    return back()
    ->with('sukses', 'Dokumen dengan nomor '.$izinid);
}

    public function upja(Request $request)
    {
        $izin = IzinvendorModel::where('izin_id', 'LIKE', '%'.$request->get('term'). '%')
                    ->where('status', 'Expired')
                    ->orWhere('status', 'Open')
                    ->orWhere('status', 'On Progress')
                    ->distinct()
                    ->get();

       $data = array();
        foreach ($izin as $hsl)
            {
                $data[] = $hsl->izin_id;
            }

        return response()->json($data);
        
    }


    public function izinkerja1($cari, $start, $end)
    {
        $index = IzinvendorModel::with('izin_informasi','izin_validasi')
        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()])
        ->whereRelation('izin_informasi', function ($query) use ($cari, $start , $end){
                    $query->where ('pemohon', 'LIKE', '%'.$cari.'%')
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()]);
                })
        ->orwhereRelation('izin_informasi', function ($query) use ($cari, $start , $end){
                    $query->where ('perusahaan_pemohon', 'LIKE', '%'.$cari.'%')
                        ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()]);
                })
        ->orwhere('izin_id', 'LIKE', '%'.$cari.'%')
        ->orderBy('created_at', 'DESC')
        ->paginate(100000000);

        $index->appends(['start' => $start, 'end' => $end]);

        $pdf = PDF::loadView('pekerjaan.izinpdf', compact('index', 'cari', 'start', 'end'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Izin Kerja '.$cari.'.pdf');
    }

public function izinkerja2($start, $end)
{
    $cari = null;
        $index = IzinvendorModel::with('izin_informasi','izin_validasi')
            ->whereBetween('created_at', [Carbon::createFromFormat('Y-m-d', $start)->startOfDay(), Carbon::createFromFormat('Y-m-d', $end)->endOfDay()])
            ->paginate(100000000)
            ->appends(request()->input());

            $index->appends(['start' => $start, 'end' => $end]);
        
        $pdf = PDF::loadView('pekerjaan.izinpdf', compact('index','cari', 'start', 'end'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Izin Kerja '.Carbon::parse($start)->isoFormat('DD-MM-YY').'-'.Carbon::parse($end)->isoFormat('DD-MM-YY').'.pdf');
}

public function izinkerja3($cari)
{
    $start = null;
    $end = null;
        $index = IzinvendorModel::with(['izin_informasi','izin_validasi'])
            ->whereRelation('izin_informasi', 'pemohon', 'LIKE', '%'.$cari.'%')
            ->orwhereRelation('izin_informasi', 'perusahaan_pemohon', 'LIKE', '%'.$cari.'%')
            ->orwhere('izin_id', 'LIKE', '%'.$cari.'%')
            ->orderBy('created_at', 'DESC')
            ->paginate(10000000)
            ->appends(request()->input());


        $pdf = PDF::loadView('pekerjaan.izinpdf', compact('index', 'cari', 'start', 'end'))->setPaper('a4', 'landscape');

        return $pdf->stream('Laporan Izin Kerja '.$cari.'.pdf');
}

} 