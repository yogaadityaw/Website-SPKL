<?php

namespace App\Http\Controllers\DashboardKabengController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PengajuanSpklController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'pengajuan-spkl';
        return view('kabeng-views.pengajuan-spkl', compact('type_menu'));
    }
}
