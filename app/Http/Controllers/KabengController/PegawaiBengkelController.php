<?php

namespace App\Http\Controllers\KabengController;

use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Pt;
use App\Models\Role;
use App\Models\Spkl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiBengkelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Mendapatkan ID bengkel dari user yang sedang login
        $bengkelId = Auth::user()->kabeng->id_bengkel;

        // Mendapatkan data pegawai dengan paginasi dan diurutkan berdasarkan 'created_at'
        $pegawaiBengkel = User::where('bengkel_id', $bengkelId)
            ->orderBy('created_at', 'desc')
            ->paginate(10);  // Ganti angka 10 dengan jumlah data per halaman yang diinginkan

        // Mengambil semua data roles, pts, departemens, dan bengkels
        $roles = Role::all();
        $pts = Pt::all();
        $departemens = Departemen::all();
        $bengkels = Bengkel::all();

        return view('kabeng-views.daftar-pegawai-bengkel', compact('pegawaiBengkel', 'roles', 'pts', 'departemens', 'bengkels'));
    }
}
