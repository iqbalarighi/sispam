<?php

namespace App\Http\Controllers;

use App\Models\SiteModel;
use Illuminate\Http\Request;

class BencanaController extends Controller
{
    public function index()
    {
         return view('bencana.index');
    }

    public function tambah()
    { 
        $site = SiteModel::get();
         return view('bencana.input',compact('site'));
    }
   
}
