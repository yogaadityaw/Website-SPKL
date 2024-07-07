<?php

namespace App\Http\Controllers;

use App\Models\QRCode;
use App\Models\Spkl;

class CommonSpklController extends Controller
{
    public function getSpkl($id)
    {
        try {
            $spkls = Spkl::where('spkl_number', $id)->first();
            $qr = QRCode::where('spkl_id', $spkls->id_spkl)->first();
            return view('common.detail-spkl', compact('spkls', 'qr'));
        } catch (\Exception $e) {
            // TODO: Add error exception
            $errorMessage = "Data yang anda cari tidak ditemukan!";
            return view('pages.error-404', compact("errorMessage"));
        }
    }
}
