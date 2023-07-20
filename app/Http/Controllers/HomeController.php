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
        $giats = KegiatanModel::orderBy('created_at','DESC')->limit(5)->paginate(5);

        $jadi = KejadianModel::orderBy('created_at','DESC')->take(3)->paginate(3);

            if($request->ajax()){
               return response()->json(compact('giats','jadi'));
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
