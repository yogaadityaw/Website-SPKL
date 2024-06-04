<?php

namespace App\Http\Controllers\KabengController;

use App\Http\Controllers\Controller;
use App\Models\Spkl;
use Illuminate\Http\Request;

class DashboardKabengController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('dashboard-kabeng');
    }

    public function printSpkl($id_spkl)
    {
        $spkl = Spkl::findOrFail($id_spkl);

        return view('print-spkl', compact('spkl'));
    }

}
