<?php


namespace App\Http\Controllers\KemenproController;

use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Spkl;
use App\Models\User;
use Illuminate\Http\Request;

class PengajuanSpklKemenproController extends Controller
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

        return view('kemenpro-views.pengajuan-spkl-kemenpro', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {

        $spkls = Spkl::with('pt', 'proyek', 'departemen', 'bengkel', 'user')->orderBy('id_spkl', 'desc')->findOrFail($id);
        return view('kemenpro-views.detail-spkl-kemenpro', compact('spkls'));
    }

    public function auditSpkl(Request $request)
    {
        if ($request->input('action') == 'approve') {
            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                if ($spkl->is_kemenpro_acc) {
                    return redirect()->route('pengajuan-spkl-kemenpro')->with('error', 'SPKL sudah disetujui');
                }
                $spkl->update([
                    'is_kemenpro_acc' => true
                ]);
                return redirect()->route('pengajuan-spkl-kemenpro')->with('success', 'SPKL berhasil disetujui');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl-kemenpro')->with('error', $e->getMessage());
            }
        } else if ($request->input('action') == 'reject') {
            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                $spkl->update([
                    'is_kemenpro_acc' => false,
                    'status' => 'Reject'
                ]);
                return redirect()->route('pengajuan-spkl-kemenpro')->with('success', 'SPKL berhasil ditolak');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl-kemenpro')->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('pengajuan-spkl-kemenpro')->with('error', 'Tidak ada aksi yang dipilih');
        }
    }
}
