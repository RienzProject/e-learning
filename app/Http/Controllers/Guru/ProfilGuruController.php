<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfilGuruController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.guru.profil-guru.index', compact('user'));
    }

    public function ubahPassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required',
            'konfirmasi_password_baru' => 'required',
        ]);

        if ($request->password_baru !== $request->konfirmasi_password_baru) {
            return redirect()->back()->with('error', 'Konfirmasi password tidak cocok dengan password baru!');
        }

        $user = Auth::user();

        if (!Hash::check($request->password_lama, $user->password)) {
            return redirect()->back()->with('error', 'Password lama tidak sesuai!');
        }

        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->back()->with('success', 'Password berhasil diubah.');
    }

    public function uploadFoto(Request $request)
    {
        $request->validate([
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $user = Auth::user();
    
        if ($user->foto) {
            Storage::delete('public/foto/' . $user->foto);
        }
    
        $file = $request->file('foto');
        $namaFile = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('public/foto', $namaFile);
        $user->foto = $namaFile;
        $user->save();
    
        return redirect()->back()->with('success', 'Foto profil berhasil diupload.');
    }
}
