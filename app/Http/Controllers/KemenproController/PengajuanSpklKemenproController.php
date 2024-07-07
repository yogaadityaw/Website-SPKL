<?php


namespace App\Http\Controllers\KemenproController;

use App\Helper\GenerateRandomSpklNumber;
use App\Helpers\GenerateQRCode;
use App\Http\Controllers\Controller;
use App\Models\Bengkel;
use App\Models\Departemen;
use App\Models\Proyek;
use App\Models\Pt;
use App\Models\QRCode;
use App\Models\Spkl;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $spkls = Spkl::where('is_kabeng_acc', true)->where('is_departemen_acc', true)->orderBy('created_at', 'desc')->paginate(10);

        return view('kemenpro-views.pengajuan-spkl-kemenpro', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {

        $spkls = Spkl::where('spkl_number', $id)->first();
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('kemenpro-views.detail-spkl-kemenpro', compact('spkls', 'qr'));
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
                    'is_kemenpro_acc' => true,
                    'status' => 'approved'
                ]);

                $qr = GenerateQRCode::generate(Auth::user()->user_nip);
                $qr_data = QRCode::where('spkl_id', $spkl->spkl_number)->first();
                $qr_data->update([
                    'pj_proyek_qr_code' => $qr
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
                    'status' => 'rejected'
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
