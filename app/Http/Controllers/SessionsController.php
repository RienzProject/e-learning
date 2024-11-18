<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username'=>'required',
            'password'=>'required' 
        ]);

        if(Auth::attempt($attributes))
        {
            session()->regenerate();
            if(Auth::user()->role == "Kepala Sekolah") {
                return redirect('dashboard-kepala-sekolah')->with(['success'=>'Kamu sudah login']);
            } else if(Auth::user()->role == "Wali Kelas") {
                return redirect('dashboard-wali-kelas')->with(['success'=>'Kamu sudah login']);
            } else if(Auth::user()->role == "Guru") {
                return redirect('dashboard-guru');
            }
        }
        else{
            return back()->withErrors(['username'=>'Nama user atau password anda salah...']);
        }
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login');
    }
}
