<?php

namespace App\Http\Controllers;
use App\Models\KejadianModel;
use App\Models\KegiatanModel;
use App\Models\SiteModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $giats = KegiatanModel::latest()->take(5)->get();

        $jadi = KejadianModel::latest()->take(3)->get();
    
    // $giat = KegiatanModel::select('created_at')->latest()->take(5)->get();

        foreach ($giats as $key => $value) {
            $time [] = $value->created_at->diffForHumans();
        }

        foreach ($jadi as $key => $value) {
            $times [] = $value->created_at->diffForHumans();
        }

$datas = ['giats' => $giats, 'time' => $time];
$datax = ['jadi' => $jadi, 'times' => $times];

         // dd($datas);

       
            if($request->ajax()){
               return response()->json(compact('datas','datax'));
            }

    return view('dashboard.home', compact('giats'));
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
