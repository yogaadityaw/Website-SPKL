<?php

namespace App\Http\Controllers\KabengController;

use App\Helpers\GenerateQRCode;
use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Spkl;
use App\Models\User;

class PengajuanSpklKabengController extends Controller
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

        return view('kabeng-views.pengajuan-spkl', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {

        $spkls = Spkl::with('pt', 'proyek', 'departemen', 'bengkel', 'user')->orderBy('id_spkl', 'desc')->findOrFail($id);
//        dd($spkls);

        return view('kabeng-views.detail-spkl-bengkel', compact('spkls'));
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

    public function deletespkl(Request $request)
    {
        try {
            $spkls = Spkl::findOrFail($request->spkl_id);
            $spkls->delete();
            return redirect()->route('pengajuan-spkl')->with('success', 'SPKL berhasil dihapus');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan-spkl')->with('error', 'SPKL gagal dihapus');
        }
    }

    public function getspklDelete($id_spkl)
    {
        $spkl = Spkl::findOrFail($id_spkl);
        return response()->json($spkl);
    }

    public function auditSpkl(Request $request)
    {
        if ($request->input('action') == 'approve') {

            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                if ($spkl->is_kabeng_acc) {
                    return redirect()->route('pengajuan-spkl')->with('error', 'SPKL sudah disetujui');
                }
                $spkl->update([
                    'is_kabeng_acc' => true
                ]);

                $path = 'public/qrcodes';
                $user_id = Auth::user()->user_nip;
                $filename = $user_id . '-' . $spkl->spkl_number;
                $qr = GenerateQRCode::generate(Auth::user()->user_nip);
                $saved = Storage::disk($path)->put($filename . '.png', $qr->png());
                dd($saved);

                return redirect()->route('pengajuan-spkl')->with('success', 'SPKL berhasil disetujui');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl')->with('error', $e->getMessage());
            }
        } else if ($request->input('action') == 'reject') {
            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                $spkl->update([
                    'is_kabeng_acc' => false,
                    'status' => 'Reject'
                ]);
                return redirect()->route('pengajuan-spkl')->with('success', 'SPKL berhasil ditolak');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl')->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('pengajuan-spkl')->with('error', 'Action tidak ditemukan');
        }
    }
}

