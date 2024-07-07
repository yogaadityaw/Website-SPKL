<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Spkl;
use App\Models\Bengkel;
use App\Models\UserSpkl;

class DashboardAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard-admin');
    }

    public function listSpklAdmin()
    {
        $spkls = Spkl::orderBy('Created_at','desc')->paginate(10);
        return view('admin-views.list-spkl-admin', compact('spkls'));
    }

    public function viewSpklAdmin($id)
    {
        $spkl = Spkl::where('spkl_number', $id)->first();
        return view('admin-views.detail-spkl-admin', compact('spkl'));
    }

    public function getChart()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $workshops = Bengkel::with(['spkls' => function($query) use ($currentMonth, $currentYear)
        {
            $query->whereMonth('tanggal', $currentMonth)->whereYear('tanggal', $currentYear);
        }])->get();

        $labels = $workshops->pluck('bengkel_name');
        $data = $workshops->map(function($workshop) {
            return $workshop->spkls->count();
        });

        return response()->json([
            'labels' => $labels,
            'data' => $data
        ]);
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

            return redirect()->route('list-spkl-admin')->with('success', 'Jam realisasi berhasil diinput');
        } catch (\Throwable $th) {
            return redirect()->route('list-spkl-admin')->with('gagal', $th->getMessage());
        }
    }
}
