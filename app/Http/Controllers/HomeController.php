<?php

namespace App\Http\Controllers;
use App\Models\BencanaModel;
use App\Models\IzinvendorModel;
use App\Models\KegiatanModel;
use App\Models\KejadianModel;
use App\Models\SiteModel;
use App\Models\TukarjagaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // $giats = KegiatanModel::latest()->take(5)->get();
        $kerja = IzinvendorModel::with('izin_informasi')->where('status', 'Open')->latest()->take(2)->get();
        $kerja2 = IzinvendorModel::with('izin_informasi')->where('status', 'On Progress')->latest()->take(4)->get();
        $kerja3 = IzinvendorModel::with('izin_informasi')->where('status', 'Expired')->latest()->take(2)->get();
        $jadi = KejadianModel::where('status','Open')->latest()->take(2)->get();
        $jadi2 = KejadianModel::where('status','Resolved')->latest()->take(2)->get();
        $gawat = BencanaModel::where('status','Open')->latest()->take(3)->get();
        $gawat2 = BencanaModel::where('status','Resolved')->latest()->take(3)->get();
        // $jaga = TukarjagaModel::latest()->take(5)->get();
    // dd($kerja);
    // $giat = KegiatanModel::select('created_at')->latest()->take(5)->get();

        // foreach ($giats as $key => $value1) {
        //     $dat['id']= $value1->id;
        //     $dat['danru'] = $value1->danru;
        //     $dat['time'] = $value1->created_at->diffForHumans();

        //     $tes[] = $dat;
        // }

    foreach ($kerja as $key => $value1) {
            $ker['id']= $value1->id;
            $ker['izin_id']= $value1->izin_id;
            $ker['nm_pt']= $value1->izin_informasi->perusahaan_pemohon;
            $ker['pemohon']= $value1->izin_informasi->pemohon;
            $ker['tgl']= Carbon::parse($value1->created_at)->isoFormat('D MMMM Y');
            $ker['status'] = $value1->status;

            $tes[] = $ker;
        }

    foreach ($kerja2 as $key => $value1) {
            $ker2['id']= $value1->id;
            $ker2['izin_id']= $value1->izin_id;
            $ker2['nm_pt']= $value1->izin_informasi->perusahaan_pemohon;
            $ker2['pemohon']= $value1->izin_informasi->pemohon;
            $ker2['tgl']= Carbon::parse($value1->created_at)->isoFormat('D MMMM Y');
            $ker2['status'] = $value1->status;

            $tes2[] = $ker2;
        }

    foreach ($kerja3 as $key => $value1) {
            $ker3['id']= $value1->id;
            $ker3['izin_id']= $value1->izin_id;
            $ker3['nm_pt']= $value1->izin_informasi->perusahaan_pemohon;
            $ker3['pemohon']= $value1->izin_informasi->pemohon;
            $ker3['tgl']= Carbon::parse($value1->created_at)->isoFormat('D MMMM Y');
            $ker3['status'] = $value1->status;

            $tes3[] = $ker3;
        }
// dd($tes3);


        foreach ($jadi as $key => $value2) {
            $jadian['no_lap']= $value2->no_lap;
            $jadian['user_pelapor']= $value2->user_pelapor;
            $jadian['jenis_potensi']= $value2->jenis_potensi;
            $jadian['waktu_kejadian']= Carbon::parse($value2->waktu_kejadian)->isoFormat('D MMMM Y');
            $jadian['updated_at']= Carbon::parse($value2->updated_at)->isoFormat('D MMMM Y');
            $jadian['status'] = $value2->status;

            $jad[] = $jadian;
        }

        foreach ($jadi2 as $key => $valjad) {
            $jadddd['no_lap']= $valjad->no_lap;
            $jadddd['user_pelapor']= $valjad->user_pelapor;
            $jadddd['jenis_potensi']= $valjad->jenis_potensi;
            $jadddd['waktu_kejadian']= Carbon::parse($valjad->waktu_kejadian)->isoFormat('D MMMM Y');
            $jadddd['updated_at']= Carbon::parse($valjad->updated_at)->isoFormat('D MMMM Y');
            $jadddd['status'] = $valjad->status;

            $jadd[] = $jadddd;
        }


        foreach ($gawat as $key => $gaw) {
            $wat['id']= $gaw->id;
            $wat['no_bencana']= $gaw->no_bencana;
            $wat['jenis_bencana']= $gaw->jenis_bencana;
            $wat['tanggal_kejadian']= Carbon::parse($gaw->tanggal)->isoFormat('D MMMM Y');
            $wat['updated_at']= Carbon::parse($gaw->updated_at)->isoFormat('D MMMM Y');
            $wat['status'] = $gaw->status;

            $gawats[] = $wat;
        }

        foreach ($gawat2 as $key => $daru) {
            $wats['id']= $daru->id;
            $wats['no_bencana']= $daru->no_bencana;
            $wats['jenis_bencana']= $daru->jenis_bencana;
            $wats['tanggal_kejadian']= Carbon::parse($daru->tanggal)->isoFormat('D MMMM Y');
            $wats['updated_at']= Carbon::parse($daru->updated_at)->isoFormat('D MMMM Y');
            $wats['status'] = $daru->status;

            $gawats2[] = $wats;
        }
// dd(count($jadi) != null);

      if (count($kerja2) == null && count($kerja3) == null && count($kerja) != null) {
    $yyy = $tes;
} elseif (count($kerja2) == null && count($kerja3) != null && count($kerja) != null) {
    $yyy = array_merge($tes,$tes3);
} elseif (count($kerja) == null && count($kerja3) == null && count($kerja2) != null) {
    $yyy = $tes2;
} elseif (count($kerja) == null && count($kerja3) != null && count($kerja2) != null) {
    $yyy = array_merge($tes2,$tes3);
} elseif (count($kerja) == null && count($kerja2) == null && count($kerja3) != null) {
    $yyy = $tes3;
}elseif (count($kerja3) == null && count($kerja) != null && count($kerja2) != null) {
    $yyy = array_merge($tes,$tes2);
} elseif (count($kerja) == null && count($kerja3) == null && count($kerja2) == null) {
     $yyy = [];
} elseif (count($kerja) != null && count($kerja2) != null && count($kerja3) != null) {
    $yyy = array_merge($tes,$tes2,$tes3);
}

// dd($yyy);

if (count($gawat) == null && count($gawat2) != null) {
    $xxx = $gawats2;
} elseif (count($gawat2) == null && count($gawat) != null) {
    $xxx = $gawats;
} elseif (count($gawat) == null && count($gawat2) == null) {
     $xxx = [];
} elseif (count($gawat) != null && count($gawat2) != null) {
    $xxx = array_merge($gawats,$gawats2);
}

// dd($xxx);


if (count($jadi) == null && count($jadi2) != null) {
    $jjj = $jadd;
} elseif (count($jadi2) == null && count($jadi) != null) {
    $jjj = $jad;
} elseif (count($jadi) == null && count($jadi2) == null) {
     $jjj = [];
} elseif (count($jadi) != null && count($jadi2) != null) {
    $jjj = array_merge($jad,$jadd);
}
// dd($jjj);

        // foreach ($jaga as $key => $value3) {
        //     $timej [] = $value3->created_at->diffForHumans();
        // }

$datas = ['giats' => $yyy];
$datax = ['jadi' => $jjj];
$datay = ['gawat' => $xxx];




// $dataz = ['jaga' => $jaga, 'timej' => $timej];

          // dd($datax,$datas);

       
            if($request->ajax()){

               return response()->json(compact('datas','datax','datay'));
            }

    return view('dashboard.home');
    }


    
}
