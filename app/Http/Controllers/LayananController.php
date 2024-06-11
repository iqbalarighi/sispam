<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\LayananModel;
use App\Models\OtorisasiModel;
use App\Models\User;
use App\Models\SiteModel;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image as ResizeImage;
use PDF;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananModel $layananModel)
    {
        $layan = $layananModel->orderBy('tanggal', 'DESC')->paginate(15);
        return view('layanan.index', compact('layan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = SiteModel::get();
        return view('layanan.form', compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        // dd($request->images);

    $year = Carbon::now()->format('Y');
    $month = Carbon::now()->format('m');
    $th = Str::substr($year, -2);
    $string = 'PLKG-'.$th.$month.'-';
    $layananid = Helper::IDGenerator(new LayananModel, 'layanan_id', 4, $string); /** Generate id */
    $store = new LayananModel;
    
    $ven = $request->layanan;
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
           $layanan = $hasil;
           } else {
            $layanan = implode(',', $zin).','.$hasil;
           }

        } else{
            foreach ($request->layanan as $key => $valu) {
            $klasif[] = $valu;
        }

        $layanan = implode(',', $klasif);
        }

// dd($layanan);

if ($request->images != null) {
    $input = request()->all();

    //start of validator
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

    $store->layanan_id = $layananid;
    $store->layanan = $layanan;
    $store->lokasi = $request->gedung;
    $store->lantai = $request->lantai;
    $store->tanggal = $request->waktu;
    $store->detail_kebutuhan = $request->detail;
    $store->pic = $request->pic;
    $store->satker = $request->satker;
    $store->kontak = $request->kontak;
    $store->email = $request->email;

if ($request->images != null) {
    $files = $request->file('images');
    $image = [];

foreach ($files as $file) {
    $image_name = md5(rand(100, 1000));
    $ext = strtolower($file->getClientOriginalExtension());
    $image_full_name = $image_name.'.'.$ext;
    $image_path = public_path('storage/layanan/'.$layananid.'/');
    $image_url = $image_path.$image_full_name;

    !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
    $imagex = ResizeImage::make($file->getRealPath())
    ->resize(800, 600)
    ->save($image_path.$image_full_name);

    $image[] = $image_full_name;
    }
    $store->foto = implode('|', $image);
}

     $store->save();

     return back()
    ->with('sukses', 'berhasil tersimpan')
    ->with('id', $layananid);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LayananModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function show(LayananModel $layananModel, $id)
    {
        $show = $layananModel->where('layanan_id', '=', $id)->first();
        $otor = OtorisasiModel::all();

        $otorized = $otor->where('nama', Auth::user()->name)->first();
        return view('layanan.detail', compact('show','otor', 'otorized'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function edit(LayananModel $layananModel, $id)
    {
        $edit = $layananModel->where('layanan_id', $id)->first();
        $jenis = explode(',', $edit->layanan);
        $sites = SiteModel::where('nama_gd', '!=', $edit->lokasi)->get('nama_gd');
// dd($sites);
        return View('layanan.edit', compact('edit', 'jenis', 'sites'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayananModel $layananModel, $id)
    {
        $update = $layananModel->where('layanan_id', $id)->first();

    $ven = $request->layanan;
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
           $layanan = $hasil;
           } else {
            $layanan = implode(',', $zin).','.$hasil;
           }

        } else{
            foreach ($request->layanan as $key => $valu) {
            $klasif[] = $valu;
        }

        $layanan = implode(',', $klasif);
        }

// dd($layanan);

if ($request->images != null) {
    $input = request()->all();

    //start of validator
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

    $update->layanan = $layanan;
    $update->lokasi = $request->gedung;
    $update->lantai = $request->lantai;
    $update->tanggal = $request->waktu;
    $update->detail_kebutuhan = $request->detail;
    $update->pic = $request->pic;
    $update->satker = $request->satker;
    $update->kontak = $request->kontak;
    $update->email = $request->email;

if ($request->images != null) {
    $files = $request->file('images');
    $image = [];

foreach ($files as $file) {
    $image_name = md5(rand(100, 1000));
    $ext = strtolower($file->getClientOriginalExtension());
    $image_full_name = $image_name.'.'.$ext;
    $image_path = public_path('storage/layanan/'.$id.'/');
    $image_url = $image_path.$image_full_name;

    !is_dir($image_url) && File::makeDirectory($image_path, $mode = 0777, true, true);
    $imagex = ResizeImage::make($file->getRealPath())
    ->resize(800, 600)
    ->save($image_path.$image_full_name);

    $image[] = $image_full_name;
    }

    // $update->foto = implode('|', $image);

    if ($update->foto == null) {
        $tambah = implode('|', $image);
    } else {
        $tambah = $update->foto.'|'.implode('|', $image);
    }
    
    $update->foto = $tambah;
}

     $update->save();

     return back()
    ->with('success', 'Update tersimpan');
    }

    public function validasi(LayananModel $layananModel, $id)
    {
        $validasi = $layananModel->where('layanan_id', $id)->first();

        return view('layanan.validasi', compact('validasi'));
    }

    public function valid(Request $request, LayananModel $layananModel, $id)
    {
        $valid = $layananModel->findOrFail($id);

        $expired = Carbon::parse($valid->tanggal)->addHours(24);
        $periksa = Auth::user()->name;
        $validator = Auth::user()->id;

        $valid->expired = $expired;
        $valid->status = $request->izin;
        $valid->pemeriksa = $periksa;
        $valid->keterangan = $request->ket;
        $valid->validatedby = $validator;

        $valid->save();

        return back()
        ->with('success', 'Validasi permintaan berhasil');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(LayananModel $layananModel, $id)
    {
        $destroy = $layananModel->where('layanan_id', $id);
        // dd($destroy);
        $destroy->delete();

        return back()
        ->with('sukses', 'Data terhapus');
    }

    public function savePDF(LayananModel $layananModel, $id, $oto, $val)
    {
        // dd($val);
        $show = $layananModel->where('layanan_id', '=', $id)->first();
        $otor = OtorisasiModel::findOrFail($oto);
        $valid = User::findOrFail($val);

if(($show->expired) == null){
    return back()
    ->with('abort', 'Dokumen belum di validasi !');
}

if($show->status == "Cancelled" || $show->status == "Cancelled by user"){
    $status = "Permohonan Ditolak";
} else {
    $status = "Permohonan Diterima";
}


$text = 
"Nama: ".$otor->nama."
Jabatan : ".$otor->jabatan."
NIP : ".$otor->nip."
Tanggal Validasi ".Carbon::parse($show->tanggal)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".carbon::parse($show->expired)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status : ".$status;

        $text2 = 
"Nama: ".$valid->name."
Unit Kerja : ".$valid->unit_kerja."
Tanggal Validasi ".Carbon::parse($show->tanggal)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Berlaku Sampai : ".carbon::parse($show->expired)->isoFormat('DD/MM/YYYY HH:mm:ss')."
Status :".$status;

        $qrcode = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text));
        $qrcode2 = base64_encode(QrCode::format('svg')->size(80)->errorCorrection('H')->generate($text2));

        $pdf = PDF::loadView('layanan.savepdf', compact('show','qrcode','qrcode2','otor'));
        
        return $pdf->stream('Izin Layanan Kelogistikan '.$show->layanan_id.'.pdf');
    }

public function hapusFoto(LayananModel $layananModel, $foto, $id)
{

        $hafot = $layananModel->where('layanan_id', $id)->first();
        $del = explode('|',$hafot->foto);
        $items = $del;

        $imagesToRemove = [$foto];
        $poto = [];

        $collection = collect($items)->reject(function ($value) use ($imagesToRemove) {
            return in_array($value, $imagesToRemove);
        });

            foreach ($collection as $file) {
            $image_name = $file;
            $poto[] = $image_name;
            }

        $dele = File::delete(public_path('storage/layanan/'.$hafot->layanan_id.'/'.$foto));

        if ($dele == true) {
        $hafot->foto = implode('|', $poto);
        $hafot->save();
        }
        return back()
        ->with('success','Hapus Foto Berhasil');

}

    public function status(Request $request, LayananModel $layananModel)
    {
        $update = $layananModel->where('layanan_id', $request->id)->first();
        $notfind = "Nomor Dokumen Tidak Ditemukan";

        if ($request->id == null) {
            return view('layanan.status', compact('update'));
        } else {

        if ($update == null){
            return back()
            ->with('notfind', $notfind);

        } else {

                if ($update->status == "Closed" && $update->puas_layanan != null) {
                return back()
                ->with('selesai', 'Permintaan Anda sebelumnya sudah selesai')
                ->with('id', $request->id);
                } 

                if ($update->status == "Closed") {
                return back()
                ->with('Closed', 'Permintaan Anda sebelumnya sudah selesai')
                ->with('id', $request->id);
                } 

                if ($update->status == "Open") {
                return back()
                ->with('Open', 'Dokumen Anda belum di Proses')
                ->with('id', $update->layanan_id);
                } 

                if ($update->status == "Cancelled") {
                    return back()
                    ->with('Cancelled', 'Permintaan Anda sebelumnya sudah selesai');
                }

        }

        }
        return view('layanan.status', compact('update'));
    }

    public function status2(Request $request, LayananModel $layananModel, $id)
    {
        $update = $layananModel->where('layanan_id', $id)->first();

        $update->status = $request->status;

       if($request->status == "Closed"){
        $update->save();
        return redirect('layanan/status')
        ->with('Closed', 'Status permintaan telah terupdate!')
        ->with('id', $id);
       }
       if($request->status == "Cancelled by user"){
        $update->save();
        return redirect('layanan/status')
        ->with('Cancelled', 'Status permintaan telah terupdate!');
       }

        // return view('layanan.kepuasan', compact('update'));
    }

    public function stat(Request $request, LayananModel $layananModel)
    {
        $izin = $layananModel->where('layanan_id', 'LIKE', '%'.$request->get('term'). '%')
                    ->where('status', 'Open')
                    ->orWhere('status', 'Done')
                    ->orWhere('status', 'On Progress')
                    ->orWhere('status', 'Closed')
                    ->distinct()
                    ->get();

       $data = array();
        foreach ($izin as $hsl)
            {
                $data[] = $hsl->layanan_id;
            }

        return response()->json($data);
        
    }

    public function survei(Request $request, LayananModel $layananModel, $id)
    {
        $survei = $layananModel->where('layanan_id', $id)->first();

        // dd($survei);

        $survei->puas_layanan = $request->cepat;
        $survei->puas_perilaku =$request->perilaku;
        $survei->masukan = $request->masukan;

        $survei->save();

        return redirect('layanan/status')
        ->with('selesai', 'Terima kasih telah memberikan penilaian kepada kami');
    }

    public function otor(LayananModel $layananModel, $id, $oto)
    {
        // dd($id, $oto, $note);

        $otor = $layananModel->where('layanan_id', $id)->first();

        if ($otor->validatedby == null) {
            return back()
        ->with('abort', 'Dokumen Belum di validasi');
        }

        dd($id, $otor);
        $otor->otorizedby = $oto;

        $otor->save();

        return back()
        ->with('success', 'Otorisasi Dokumen Berhasil');
    }

        public function otori(LayananModel $layananModel, $id, $oto, $note)
    {

        // dd($id, $oto, $note);
        $otor = $layananModel->where('layanan_id', $id)->first();

        if ($otor->validatedby == null) {
            return back()
        ->with('abort', 'Dokumen Belum di validasi');
        }

        $otor->otorizedby = $oto;
        $otor->note = $note;

        $otor->save();

        return back()
        ->with('success', 'Otorisasi Dokumen Berhasil');
    }

    public function superoto(LayananModel $layananModel, $id)
    {
       dd($id);
    }
}
