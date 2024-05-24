<?php

namespace App\Http\Controllers\PegawaiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
        $userspkls = UserSpkl::where('user_id', $logged_user->id_user)->get();

        if (!$userspkls) {
            return view('pegawai-views.surat-pengajuan')->with('error', 'gagal menampilkan data spkl');
        }
        $spkls = $userspkls->map(function ($userspkl) {
            return Spkl::findOrFail($userspkl->spkl_id);
        });

        return view('pegawai-views.surat-pengajuan', compact('spkls'));
    }

    public function absen(Request $request)
    {
        $userSpkl = UserSpkl::findOrFail($request->user_spkl_id);

        if ($userSpkl->check_in && $userSpkl->image) {
            return redirect()->route('list-spkl-pegawai')->with('error', 'Anda sudah absen');
        }
        
        $base64ImageData = $request->image;
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64ImageData));
        $file_name = time() . '_' . $request->user_name . '.png';
        $filePath = 'public/images/' . $file_name;
        Storage::disk('local')->put($filePath, $decodedImageData);

        $userSpkl->update([
            'image' => $file_name,
            'check_in' => now(),
        ]);

        return redirect()->route('list-spkl-pegawai')->with('success', 'Data proyek baru berhasil ditambahkan');;
    }
}
