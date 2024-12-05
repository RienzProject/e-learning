<?php

namespace App\Http\Controllers\KepalaSekolah;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BiodataSekolahController extends Controller
{
    public function index()
    {
        return view('pages.kepala-sekolah.biodata-sekolah.index', compact('user'));
    }
}