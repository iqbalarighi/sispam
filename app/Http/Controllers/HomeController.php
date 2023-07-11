<?php

namespace App\Http\Controllers;
use App\Models\PersonilModel;
use App\Models\SiteModel;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {   $cari = $request->cari;
        if ($cari != null) {
            $personil = PersonilModel::where('nama', 'LIKE', '%'.$cari.'%')
            ->orWhere('nip', 'LIKE', '%'.$cari.'%')
            ->orWhere('jabatan', 'LIKE', '%'.$cari.'%')
            ->orderby('nip','ASC')
            ->paginate(15)
            ->appends(request()->input());

        return view('personil.home', compact('personil'));
        } else {
         $personil = PersonilModel::orderby('nip','ASC')->paginate(15);
        return view('personil.home', compact('personil'));  
        }

        
     }

    public function detil($id)
    {
        $s = PersonilModel::with('site')->findOrFail($id);
        return view('personil.detil', ['s' => $s]);

    }

    public function edit(Request $request, $id)
    {
        $personil = PersonilModel::with('site')->findOrFail($id);
        $id = SiteModel::where('id', '=', $personil->site->id)->get(['id']);
        $site = SiteModel::where('id', '!=', $personil->site->id)->get(['id', 'nama_gd']);
        return view('personil.edit', ['personil' => $personil, "site" => $site, "id" => $id]);
    }

    public function hapus($id)
    {
        $hapus = PersonilModel::findOrFail($id);
        $personil = $hapus->nama;
        $nip = $hapus->nip;

       $del = File::deleteDirectory(public_path('storage/personil/'.$nip));

       if ($del == true) {
            $hapus->delete();
       } else {
        return back()
       ->with('warning','Perhatian Data Personil '.$personil.' Tidak Dapat Terhapus');
       }
       
       return back()
       ->with('berhasil','Personil '.$personil.' Sudah Terhapus');
    }

    public function hapusProfil($id)
    {
        $hapus = PersonilModel::findOrFail($id);
        $nip = $hapus->nip;
        $ft = $hapus->foto_personil;

       $del = File::delete(public_path('storage/personil/'.$nip.'/'.$ft.''));

       if ($del == true) {
            $hapus->foto_personil = '';
            $hapus->save();
       } 
       return back()
             ->with('success','Foto Profil Terhapus');
    }

    public function hapusKta($id)
    {
        $hapus = PersonilModel::findOrFail($id);
        $nip = $hapus->nip;
        $kta = $hapus->foto_kd;

       $del = File::delete(public_path('storage/personil/'.$nip.'/'.$kta.''));

       if ($del == true) {
        $hapus->foto_kd = '';
        $hapus->save();

        return back()
        ->with('success','Foto KTA Terhapus');
       } 
    }

    public function hapusBpjss($id)
    {
        $hapus = PersonilModel::findOrFail($id);
        $nip = $hapus->nip;
        $bpjss = $hapus->foto_bpjss;

       $del = File::delete(public_path('storage/personil/'.$nip.'/'.$bpjss.''));

       if ($del == true) {
        $hapus->foto_bpjss = '';
        $hapus->save();

        return back()
        ->with('success','Foto BPJS Kesehatan Terhapus');
       } 
    }

    public function hapusBpjsk($id)
    {
        $hapus = PersonilModel::findOrFail($id);
        $nip = $hapus->nip;
        $bpjsk = $hapus->foto_bpjsk;

       $del = File::delete(public_path('storage/personil/'.$nip.'/'.$bpjsk.''));

       if ($del == true) {
        $hapus->foto_bpjsk = '';
        $hapus->save();

        return back()
        ->with('success','Foto BPJS Ketenagakerjaan Terhapus');
       } 
    }

    public function showInput()
    {
        $site = SiteModel::all();
        return view('personil.input', ['site' => $site]);

    }

    public function simpan(Request $request)
    {
        $nama = $request->nama;
        $validator = $request->validate([
            'nip' => 'unique:personil',
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'kta' => 'image|mimes:jpg,jpeg,png|max:1024',
            'bpjss' => 'image|mimes:jpg,jpeg,png|max:1024',
            'bpjsk' => 'image|mimes:jpg,jpeg,png|max:1024',
        ],
        [
            'nip.unique' => 'Nip Yang Anda Masukkan Sudah Terdaftar !!!',
            'foto.image' => 'Foto Profil harus berupa File Gambar',
            'foto.mimes' => 'File Gambar yang diterima dengan format :values',
            'kta.image' => 'KTA harus berupa File Gambar',
            'kta.mimes' => 'File Gambar yang diterima dengan format :values',
            'bpjss.image' => 'Kartu BPJS Kesehatan harus berupa File Gambar',
            'bpjss.mimes' => 'File Gambar yang diterima dengan format :values',
            'bpjsk.image' => 'Kartu BPJS Ketenagakerjaan harus berupa File Gambar',
            'bpjsk.mimes' => 'File Gambar yang diterima dengan format :values',
        ]);
        $input = new PersonilModel;
        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $nip = $request->nip;
        $string = $th.$month.$nip;

        if ($request->file('foto') != null) {
        $ext = $request->file('foto')->getClientOriginalExtension();
        $imageName = $string.'.'.$ext;
            $request->file('foto')->move(public_path('storage/personil/'.$nip.'/'), $imageName);
        $input->foto_personil = $imageName;
        }

        if ($request->file('kta') != null) {
        $ext1 = $request->file('kta')->getClientOriginalExtension();
        $imageName1 = $nip.'.'.$ext1;
            $request->file('kta')->move(public_path('storage/personil/'.$nip.'/'), $imageName1);
        $input->foto_kd = $imageName1;
        }

        if ($request->file('bpjss') != null) {
        $bpjss = $request->bpjs_sehat;
        $ext2 = $request->file('bpjss')->getClientOriginalExtension();
        $imageName2 = $bpjss.'.'.$ext2;
            $request->file('bpjss')->move(public_path('storage/personil/'.$nip.'/'), $imageName2);
        $input->foto_bpjss = $imageName2;
        }

        if ($request->file('bpjsk') != null) {
        $bpjsk = $request->bpjs_kerja;
        $ext3 = $request->file('bpjsk')->getClientOriginalExtension();
        $imageName3 = $bpjsk.'.'.$ext3;
            $request->file('bpjsk')->move(public_path('storage/personil/'.$nip.'/'), $imageName3);
        $input->foto_bpjsk = $imageName3;
        }

        
        $input->nip = $nip;
        $input->nama = $nama;
        $input->jabatan = $request->jabatan;
        $input->gender = $request->gender;
        $input->pendidikan = $request->pendidikan;
        $input->lokasi_tugas = $request->lokasi_tugas;
        $input->kd = $request->kd;
        $input->no_hp = $request->no_hp;
        $input->alamat = $request->alamat;
        $input->bank = $request->bank;
        $input->norek = $request->norek;
        $input->bpjs_sehat = $request->bpjs_sehat;
        $input->bpjs_kerja = $request->bpjs_kerja;
        $input->lama_kerja = $request->lama_kerja;
        $input->save();

    return back()
            ->with('success','Hi Admin,')
            ->with('name', $nama);
    }


public function update(Request $request, $id)
    {    
        $validator = $request->validate([
            'foto' => 'image|mimes:jpg,jpeg,png|max:1024',
            'kta' => 'image|mimes:jpg,jpeg,png|max:1024',
            'bpjss' => 'image|mimes:jpg,jpeg,png|max:1024',
            'bpjsk' => 'image|mimes:jpg,jpeg,png|max:1024',
        ],
        [
            'foto.image' => 'Foto Profil harus berupa File Gambar',
            'foto.mimes' => 'File Gambar yang diterima dengan format :values',
            'kta.image' => 'KTA harus berupa File Gambar',
            'kta.mimes' => 'File Gambar yang diterima dengan format :values',
            'bpjss.image' => 'Kartu BPJS Kesehatan harus berupa File Gambar',
            'bpjss.mimes' => 'File Gambar yang diterima dengan format :values',
            'bpjsk.image' => 'Kartu BPJS Ketenagakerjaan harus berupa File Gambar',
            'bpjsk.mimes' => 'File Gambar yang diterima dengan format :values',
        ]);

        $year = Carbon::now()->format('Y');
        $month = Carbon::now()->format('m');
        $th = Str::substr($year, -2);
        $nip = $request->nip;
        $string = $th.$month.$nip;

        $personil = PersonilModel::findOrFail($id);

        //foto profil personil
        if ($request->file('foto') != null) {
            $ft = $personil->foto_personil;
            File::delete(public_path('storage/personil/'.$nip.'/'.$ft.''));

            $ext = $request->file('foto')->getClientOriginalExtension();            
            $imageName = $string.'.'.$ext;
            $request->file('foto')->move(public_path('storage/personil/'.$nip.'/'), $imageName);
            
            $personil->foto_personil = $imageName;
            $personil->save();
        } 

        //foto KTA
        if ($request->file('kta') != null) {
            $kta = $personil->foto_kd;
            File::delete(public_path('storage/personil/'.$nip.'/'.$kta.''));

            $ext1 = $request->file('kta')->getClientOriginalExtension();
            $imageName1 = $nip.'.'.$ext1;
            $request->file('kta')->move(public_path('storage/personil/'.$nip.'/'), $imageName1);

            $personil->foto_kd = $imageName1;
            $personil->save();
        } 

        //foto bpjs sehat
        if ($request->file('bpjss') != null) {
            $bpjssf = $personil->foto_bpjss;
            File::delete(public_path('storage/personil/'.$nip.'/'.$bpjssf.''));

            $bpjss = $request->bpjs_sehat;
            $ext2 = $request->file('bpjss')->getClientOriginalExtension();
            $imageName2 = $bpjss.'.'.$ext2;
            $request->file('bpjss')->move(public_path('storage/personil/'.$nip.'/'), $imageName2);

            $personil->foto_bpjss = $imageName2;
            $personil->save();;
        } 

        //foto bpjs kerja
        if ($request->file('bpjsk') != null) {
            $bpjskf = $personil->foto_bpjsk;
            File::delete(public_path('storage/personil/'.$nip.'/'.$bpjskf.''));

            $bpjsk = $request->bpjs_kerja;
            $ext3 = $request->file('bpjsk')->getClientOriginalExtension();
            $imageName3 = $bpjsk.'.'.$ext3;
            $request->file('bpjsk')->move(public_path('storage/personil/'.$nip.'/'), $imageName3);

            $personil->foto_bpjsk = $imageName3;
            $personil->save();
        } 
        
        $personil->nama = $request->nama;
        $personil->jabatan = $request->jabatan;
        $personil->gender = $request->gender;
        $personil->pendidikan = $request->pendidikan;
        $personil->lokasi_tugas = $request->lokasi_tugas;
        $personil->kd = $request->kd;
        $personil->no_hp = $request->no_hp;
        $personil->alamat = $request->alamat;
        $personil->bank = $request->bank;
        $personil->norek = $request->norek;
        $personil->bpjs_sehat = $request->bpjs_sehat;
        $personil->bpjs_kerja = $request->bpjs_kerja;
        $personil->lama_kerja = $request->lama_kerja;
        $personil->save();
            
            return back()
            ->with('success','Data berhasil di Update');  
        } 

}
