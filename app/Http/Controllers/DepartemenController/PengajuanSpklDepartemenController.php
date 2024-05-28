<?php

namespace App\Http\Controllers\DepartemenController;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Helper\GenerateRandomSpklNumber;
use App\Helpers\GenerateQRCode;
use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\Spkl;
use App\Models\User;
use App\Models\QRCode;


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
        $spkls = Spkl::where('is_kabeng_acc', true)->orderBy('id_spkl', 'desc')->get();

        return view('departemen-views.pengajuan-spkl-dep', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {

        $spkls = Spkl::orderBy('id_spkl', 'desc')->findOrFail($id);
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('departemen-views.detail-spkl-departemen', compact('spkls', 'qr'));
    }

    public function auditSpkl(Request $request)
    {
        if ($request->input('action') == 'approve') {
            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                if ($spkl->is_departemen_acc) {
                    return redirect()->route('pengajuan-spkl-departemen')->with('error', 'SPKL sudah disetujui');
                }
                $spkl->update([
                    'is_departemen_acc' => true
                ]);

                $qr = GenerateQRCode::generate(Auth::user()->user_nip);
                $qr_data = QRCode::where('spkl_id', $spkl->id_spkl)->first();
                $qr_data->update([
                    'department_head_qr_code' => $qr
                ]);

                return redirect()->route('pengajuan-spkl-departemen')->with('success', 'SPKL berhasil disetujui');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl-departemen')->with('error', $e->getMessage());
            }
        } else if ($request->input('action') == 'reject') {
            try {
                $spkl = Spkl::findOrFail($request->spkl_id);
                $spkl->update([
                    'is_departemen_acc' => false,
                    'status' => 'Reject'
                ]);
                return redirect()->route('pengajuan-spkl-departemen')->with('success', 'SPKL berhasil ditolak');
            } catch (\Exception $e) {
                return redirect()->route('pengajuan-spkl-departemen')->with('error', $e->getMessage());
            }
        } else {
            return redirect()->route('pengajuan-spkl-departemen')->with('error', 'Tidak ada aksi yang dipilih');
        }
    }
}
