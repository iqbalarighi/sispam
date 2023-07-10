<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\SiteModel;

class AdduserController extends Controller
{

    public function index()
    {
        $user = User::with('site')->paginate(10);
        $site = SiteModel::get();

        return view('adduser.index', ['user' => $user, 'site' => $site]);
    }

    public function adduser()
    {
        $site = SiteModel::get();

        return view('adduser.input', ['site' => $site]);
    }

    public function hapus($id)
    {
        $hapus = User::findOrFail($id);
        $hapus->delete();
        
       return back()
       ->with('sukses', 'User Terhapus');

    }

    public function save(Request $request)
    {
    $validator = $request->validate([
    'name' => 'required|min:3|max:50',
    'email' => 'email',
    'password' => 'required|confirmed|min:6',
]);

            $admin = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'level' => $request->level,
            'lokasi_tugas' => $request->lokasi,
            'password' => bcrypt($request->password),
        ]);

            return back()
            ->with('sukses', 'Penambahan User Berhasil');
    }

    public function updateuser(Request $request, $id)
    {   
            

        $update = User::findOrFail($id);

        if ($request->password != null) {
        $validator = $request->validate([
            'password' => 'confirmed|min:6',
        ]);
        $update->password = bcrypt($request->password);
        }

        $update->name = $request->name;
        $update->email = $request->email;
        $update->role = $request->role;
        $update->level = $request->level;
        $update->lokasi_tugas = $request->lokasi;
        $update->save();

            return back()
            ->with('sukses', 'Update User Berhasil');
    }
}
