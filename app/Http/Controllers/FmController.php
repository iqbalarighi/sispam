<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FmController extends Controller
{
   public function index(Request $request)
    {   
        return view('admin.filemanager.index');
    }
}
