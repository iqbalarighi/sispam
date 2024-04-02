<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Helpers\Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\LayananModel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ResizeImage;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LayananModel $layananModel)
    {
        $layan = $layananModel->paginate(15);
        return view('layanan.index', compact('layan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    $string = 'KLG-'.$th.$month.'-';
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
    $store->tanggal = $request->waktu;
    $store->detail_kebutuhan = $request->detail;
    $store->pic = $request->pic;
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

    $store->save();
}


 return back()
    ->with('sukses');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LayananModel  $logistikModel
     * @return \Illuminate\Http\Response
     */
    public function show(LayananModel $layananModel)
    {
        dd($layananModel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function edit(LayananModel $layananModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LayananModel $layananModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayananModel  $layananModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(LayananModel $layananModel)
    {
        //
    }
}
