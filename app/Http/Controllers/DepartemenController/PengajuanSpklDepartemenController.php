<?php

namespace App\Http\Controllers\DepartemenController;

use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Spkl;
use App\Models\User;

class PengajuanSpklDepartemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $spkl_id = GenerateRandomSpklNumber::generate();
        $users = User::all();
        $pts = Pt::all();
        $proyeks = Proyek::all();
        $departemens = Departemen::all();
        $bengkels = Bengkel::all();
        $spkls = Spkl::with('pt', 'proyek', 'departemen', 'bengkel', 'user')->orderBy('id_spkl', 'desc')->get();

        return view('departemen-views.pengajuan-spkl-dep', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {

        $spkls = Spkl::with('pt', 'proyek', 'departemen', 'bengkel', 'user')->orderBy('id_spkl','desc')->findOrFail($id);
//        dd($spkls);

        return view('departemen-views.detail-spkl-departemen', compact('spkls'));
    }
}
