<?php

namespace App\Http\Controllers\DashboardKabengController;

use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Spkl;
use App\Models\User;
use Illuminate\Http\Request;

class PengajuanSpklController extends Controller
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
        $spkls = Spkl::with('departemen')->get();

        return view('kabeng-views.pengajuan-spkl', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function post(Request $request)
    {
        try {
            $spkl = Spkl::create([
                'spkl_number' => $request->input('spkl_number'),
                'uraian_pekerjaan' => $request->input('uraian_pekerjaan'),
                'rencana' => $request->input('rencana'),
                'pelaksanaan' => $request->input('pelaksanaan'),
                'tanggal' => $request->input('tanggal'),
                'jam_realisasi' => $request->input('jam_realisasi'),
                'pt_id' => $request->input('pt_id'),
                'proyek_id' => $request->input('proyek_id'),
                'departemen_id' => $request->input('departemen_id'),
                'bengkel_id' => $request->input('bengkel_id'),
                'user_id' => $request->input('user_id'),
            ]);

            return redirect()->route('pengajuan-spkl')->with('success', 'Data SPKL berhasil diajukan');
        } catch (\Exception $e) {
            dd("Error $e");
        }
    }
}
