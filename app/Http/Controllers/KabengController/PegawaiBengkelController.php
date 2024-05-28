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
        $bengkelId = Auth::user();
        $pegawaiBengkel = User::where('bengkel_id', $bengkelId->kabeng->id_bengkel)->orderBy('id_user', 'desc')->get();

        $roles = Role::all();
        $pts = Pt::all();
        $departemens = Departemen::all();
        $bengkels = Bengkel::all();

        return view('kabeng-views.daftar-pegawai-bengkel', compact('pegawaiBengkel','roles', 'pts', 'departemens', 'bengkels'));

    }
}
