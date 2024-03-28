<?php

namespace App\Http\Controllers;

use App\Models\IzinvendorModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function side(Request $request)
    {
        $count = IzinvendorModel::where('status', 'Open')->count();

        $coun = ['count' => $count ];
        

        if($request->ajax()){

               return response()->json(compact('coun'));
            }

            return response()->json(compact('coun'));
    }
}
