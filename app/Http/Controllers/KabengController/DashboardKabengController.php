<?php

namespace App\Http\Controllers\KabengController;

use App\Helpers\GenerateQRCode;
use App\Http\Controllers\Controller;
use App\Models\Spkl;
use Illuminate\Support\Facades\URL;

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
        try {
            $spkl = Spkl::where('spkl_number', $id_spkl)->first();
            $qrLink = Url::temporarySignedRoute(
                'get-spkl',
                now()->addMinutes(5),
                ['id' => $spkl->spkl_number]
            );
            $qrCode = GenerateQRCode::generate($qrLink);
            return view('print-spkl', compact('spkl', 'qrCode'));
        } catch (\Exception $e) {
            $errorMessage = "Data yang anda cari tidak ditemukan!";
            return view('pages.error-404', compact("errorMessage"));
        }
    }

}
