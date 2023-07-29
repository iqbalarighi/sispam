<?php

namespace App\Http\Controllers;
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
        $giats = KegiatanModel::latest()->take(5)->get();
        $jadi = KejadianModel::latest()->take(5)->get();
        $jaga = TukarjagaModel::latest()->take(5)->get();
    
    // $giat = KegiatanModel::select('created_at')->latest()->take(5)->get();

        foreach ($giats as $key => $value1) {
            $dat['id']= $value1->id;
            $dat['danru'] = $value1->danru;
            $dat['time'] = $value1->updated_at->diffForHumans();

            $tes[] = $dat;
        }

        foreach ($jadi as $key => $value2) {
            $jadian['no_lap']= $value2->no_lap;
            $jadian['user_pelapor']= $value2->user_pelapor;
            $jadian['jenis_potensi']= $value2->jenis_potensi;
            $jadian['waktu_kejadian']= $value2->waktu_kejadian->format('d F Y');
            $jadian['updated_at']= $value2->updated_at->diffForHumans();
            $jadian['status'] = $value2->status;

            $jad[] = $jadian;
        }

        foreach ($jaga as $key => $value3) {
            $timej [] = $value3->created_at->diffForHumans();
        }

$datas = ['giats' => $tes];
$datax = ['jadi' => $jad];
$dataz = ['jaga' => $jaga, 'timej' => $timej];

          // dd($datax,$datas);

       
            if($request->ajax()){
               return response()->json(compact('datas','datax','dataz'));
            }

    return view('dashboard.home');
    }

    public function list(Request $request)
    {
        $giats = KegiatanModel::orderBy('created_at','DESC')->take(5)->paginate(5);

            if($request->ajax()){
               return response()->json($giats);
            }
    return view('dashboard.home', compact('giats'));
    }
    
}
