<?php

namespace App\Http\Controllers\KabengController;

use App\Helpers\GenerateQRCode;
use App\Helper\GenerateRandomSpklNumber;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Jobs\sendSpkl;

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
        $spkls = Spkl::orderBy('id_spkl', 'desc')->get();

        return view('kabeng-views.pengajuan-spkl', compact('spkl_id', 'users', 'pts', 'proyeks', 'departemens', 'bengkels', 'spkls'));
    }

    public function getDetailSpkl($id)
    {
        $spkls = Spkl::orderBy('id_spkl', 'desc')->findOrFail($id);
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('kabeng-views.detail-spkl-bengkel', compact('spkls', 'qr'));
    }

    public function post(Request $request)
    {
        try {
            $logged_user = Auth::user();
            $bengkel = Bengkel::where('bengkel_head', $logged_user->id_user)->first();
            $countSpklThisMonth = Spkl::whereMonth('created_at', date('m'))->whereYear('created_at', date('Y'))->count();
            $spkl_number = $countSpklThisMonth+1 . '/' . $bengkel->bengkel_name . '/' . date('m/Y');
            $spklRandNumber = GenerateRandomSpklNumber::generate();
            $qrSpkl = GenerateQRCode::generate($spklRandNumber);

            $spkl = Spkl::create([
                'spkl_number' => $spkl_number,
                'qr_code' => $qrSpkl,
                'uraian_pekerjaan' => $request->input('uraian_pekerjaan'),
                'rencana' => $request->input('rencana'),
                'progres' => $request->input('progres'),
                'tanggal' => $request->input('tanggal'),
                'pt_id' => $request->input('pt_id'),
                'proyek_id' => $request->input('proyek_id'),
                'bengkel_id' => $bengkel->id_bengkel
            ]);

            foreach ($request->user_id as $user_id) {
                UserSpkl::create([
                    'spkl_id' => $spkl->id_spkl,
                    'user_id' => $user_id
                ]);
            }

            QRCode::create([
                'spkl_id' => $spkl->id_spkl,
            ]);



            return redirect()->route('pengajuan-spkl')->with('success', 'Data SPKL berhasil diajukan');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan-spkl')->with('error', 'Data Inputan Masih Ada Yang Kosong');
        }
    }

    public function deletespkl(Request $request)
    {
        try {
            $qrs = QRCode::where('spkl_id', $request->spkl_id)->get();
            foreach ($qrs as $qr) {
                $qr->delete();
            }
            $userSpkls = UserSpkl::where('spkl_id', $request->spkl_id)->get();
            foreach ($userSpkls as $userSpkl) {
                $userSpkl->delete();
            }
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

                if ($spkl->bengkel->departemen->user->email) {
                    $email = $spkl->bengkel->departemen->user->email;
                    sendSpkl::dispatch($spkl, $email);
                }

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

    public function inputJamRealisasi(Request $request, $id) {
        try {
            $inputData = $request->except(['_token', '_method']);
            foreach ($inputData as $key => $value) {
                if (strpos($key, 'jam_realisasi_') === 0) {
                    $userSpklId = str_replace('jam_realisasi_', '', $key);
                    $userSpkl = UserSpkl::findOrFail($userSpklId);
                    $userSpkl->update([
                        'jam_realisasi' => $value
                    ]);
                }
            }

            return redirect()->route('pengajuan-spkl')->with('success', 'Jam realisasi berhasil diinput');
        } catch (\Throwable $th) {
            return redirect()->route('pengajuan-spkl')->with('gagal', $th->getMessage());
        }
    }

    public function ubahInformasi($id)
    {
        $spkl = Spkl::findOrFail($id);
        $pts = Pt::all();
        $proyeks = Proyek::all();

        return view('kabeng-views.ubah-informasi', compact('spkl', 'pts', 'proyeks'));
    }

    public function fungsiUbahInformasi(Request $request, $id)
    {
        $spkl = Spkl::findOrFail($id);
        $spkl->update([
            'alasan_penolakan' => null,
            'progres' => $request->progres,
            'uraian_pekerjaan' => $request->uraian_pekerjaan,
            'rencana' => $request->rencana,
            'tanggal' => $request->tanggal,
            'pt_id' => $request->pt_id,
            'proyek_id' => $request->proyek_id
        ]);

        return redirect()->route('pengajuan-spkl')->with('success', 'berhasil mengubah data spkl');
    }
}
