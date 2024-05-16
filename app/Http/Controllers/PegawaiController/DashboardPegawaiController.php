<?php

namespace App\Http\Controllers\PegawaiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
        return view('pegawai-views.surat-pengajuan');
    }
}
