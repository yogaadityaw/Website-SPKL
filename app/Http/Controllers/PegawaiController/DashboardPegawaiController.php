<?php

namespace App\Http\Controllers\PegawaiController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Spkl;
use App\Models\UserSpkl;
use App\Models\QRCode;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

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
        $unfinishedSpkls = UserSpkl::where('user_id', $logged_user->id_user)
            ->where('check_out', null)
            ->get();

        $filteredSpkls = new Collection();

        foreach ($unfinishedSpkls as $userSpkl) {
            if ($userSpkl->spkl->is_kabeng_acc && $userSpkl->spkl->is_departemen_acc && $userSpkl->spkl->is_kemenpro_acc) {
                $filteredSpkls->push($userSpkl);
            }
        }

        // Paginate the filtered collection
        $perPage = 10;
        $page = request()->get('page', 1);
        $filteredSpkls = new LengthAwarePaginator(
            $filteredSpkls->forPage($page, $perPage),
            $filteredSpkls->count(),
            $perPage,
            $page,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        $finishedSpkls = UserSpkl::where('user_id', $logged_user->id_user)
            ->where('check_out', '!=', null)
            ->with('spkl')
            ->orderBy('check_out', 'desc')
            ->paginate(10);

        if ($filteredSpkls->isEmpty() && $finishedSpkls->isEmpty()) {
            return view('pegawai-views.surat-pengajuan')->with('error', 'gagal menampilkan data spkl');
        }

        return view('pegawai-views.surat-pengajuan', compact('filteredSpkls', 'finishedSpkls'));
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
            'lokasi_check_in' => $request->lokasi_check_in,
            'foto_check_in' => $file_name,
            'check_in' => now(),
        ]);

        return redirect()->route('list-spkl-pegawai')->with('success', 'Data proyek baru berhasil ditambahkan');;
    }

    public function checkout(Request $request)
    {
        $userSpkl = UserSpkl::findOrFail($request->user_spkl_id);

        if ($userSpkl->check_out && $userSpkl->image) {
            return redirect()->route('list-spkl-pegawai')->with('error', 'Anda sudah checkout');
        }

        $base64ImageData = $request->image;
        $decodedImageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64ImageData));
        $file_name = time() . '_' . $request->user_name . '.png';
        $filePath = 'public/images/' . $file_name;
        Storage::disk('local')->put($filePath, $decodedImageData);

        $userSpkl->update([
            'lokasi_check_out' => $request->lokasi_check_out,
            'foto_check_out' => $file_name,
            'check_out' => now(),
        ]);

        return redirect()->route('list-spkl-pegawai')->with('success', 'Berhasil Checkout');
    }

    public function getDetailSpkl($id)
    {
        $spkls = Spkl::findOrFail($id);
        $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();

        return view('pegawai-views.detail-spkl-pegawai', compact('spkls', 'qr'));
    }
}
