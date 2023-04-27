<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdduserController extends Controller
{

    public function index()
    {
        $user = User::paginate(10);

        return view('adduser.index', ['user' => $user]);
    }

    public function adduser()
    {
        return view('adduser.input');
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
            'password' => bcrypt($request->password),
        ]);

            return back()
            ->with('sukses', 'Penambahan User Berhasil');
    }

    public function updateuser(Request $request, $id)
    {   
            $validator = $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        $update = User::findOrFail($id);

        $update->name = $request->name;
        $update->email = $request->email;
        $update->password = bcrypt($request->password);
        $update->role = $request->role;
        $update->save();

            return back()
            ->with('sukses', 'Update User Berhasil');
    }
}
