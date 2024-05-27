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
use App\Models\UserSpkl;
use App\Models\QRCode;

class PengajuanSpklKabengController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $logged_user = Auth::user();

        $spkl_id = GenerateRandomSpklNumber::generate();
        $users = User::where('bengkel_id', $logged_user->kabeng->id_bengkel)->get();
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
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('kabeng-views.detail-spkl-bengkel', compact('spkls', 'qr'));
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
                'bengkel_id' => $request->input('bengkel_id')
            ]);

            foreach ($request->user_id as $user_id) {
                UserSpkl::create([
                    'spkl_id' => $spkl->id_spkl,
                    'user_id' => $user_id
                ]);
            }

            $departemen = Departemen::findOrFail($request->departemen_id);
            $workshop = Bengkel::findOrFail($request->bengkel_id);
            $project = Proyek::findOrFail($request->proyek_id);

            QRCode::create([
                'spkl_id' => $spkl->id_spkl,
                'workshop_head_id' => $workshop->bengkel_head,
                'department_head_id' => $departemen->departemen_head,
                'pj_proyek_id' => $project->pj_proyek,
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

                $qr = GenerateQRCode::generate(Auth::user()->user_nip);
                $qr_data = QRCode::where('spkl_id', $spkl->id_spkl)->first();
                $qr_data->update([
                    'workshop_head_qr_code' => $qr
                ]);

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
