<?php

namespace App\Http\Controllers\PegawaiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Spkl;
use App\Models\UserSpkl;

class DashboardPegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard-pegawai');
    }

    public function listSpklPegawai()
    {
        $logged_user = Auth::user();
        $spkl = UserSpkl::where('user_id', $logged_user->id_user)->get();

        return view('pegawai-views.surat-pengajuan');
    }
}
