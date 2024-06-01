<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Spkl;
use App\Models\Bengkel;

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
        $spkls = Spkl::all();
        return view('admin-views.list-spkl-admin', compact('spkls'));
    }

    public function viewSpklAdmin($id)
    {
        $spkl = Spkl::findOrFail($id);
        return view('admin-views.detail-spkl-admin', compact('spkl'));
    }

    public function getChart()
    {
        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        $workshops = Bengkel::with(['spkls' => function($query) use ($currentMonth, $currentYear) {
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
}
