<?php

namespace App\Http\Controllers;

use App\Models\AtensiModel;
use App\Models\OtorisasiModel;
use App\Models\UnrasModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AtensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AtensiModel::latest()->paginate(15);
        return view('atensi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('atensi.input');
    }    

    public function create2($id)
    {   
        $tensi = UnrasModel::findOrFail($id);
        return view('atensi.input-atensi', compact('tensi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $store= new AtensiModel;

        $store->creator = Auth::user()->name;
        $store->yth = $request->yth;
        $store->rencana = $request->rencana;
        $store->uraian = $request->uraian;
        $store->save(); 

        return back()
        ->with('sukses', $store->id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $show = AtensiModel::findOrFail($id);
        $otor = OtorisasiModel::all();
        return view('atensi.detil', compact('show','otor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = AtensiModel::findOrFail($id);
        
        return view('atensi.edit', compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = AtensiModel::findOrFail($id);

        $update->yth = $request->yth;
        $update->rencana = $request->rencana;
        $update->uraian = $request->uraian;
        $update->save(); 

        return redirect('atensi_detil/'.$update->id)
        ->with('sukses', 'Update Laporan Atensi Berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hapus = AtensiModel::findOrFail($id);
        $rencana = Str::substr($hapus->rencana, 15,10000);
            
            $hapus->delete();

            $message = 'Laporan Atensi '.$rencana.' Sudah Terhapus';
        
       return back()
       ->with('sukses', $message);
    }

    public function atensiPDF($id, $oto)
    {   
        $detil = AtensiModel::findOrFail($id);
        $otor = OtorisasiModel::findOrFail($oto);
        $rencana = Str::substr($detil->rencana, 16,10000);
        $qrcode = base64_encode(QrCode::format('svg')->size(70)->errorCorrection('H')->style('round')->generate(url('/atensiPDF/'.$detil->id.'/'.$oto)));

    if (Auth::user() == true) {
        $pdf = PDF::loadView('atensi.savepdf', compact('detil','otor','qrcode')); 
        // $pdf->get_canvas()->get_cpdf()->setEncryption('smcojk','smcojk2020');
    } else {
        header('Refresh: 10; URL='.route('dashboard'));

        abort(403);
    }
        
        return $pdf->stream('Laporan Atensi '.$rencana.'.pdf');
    }
}
