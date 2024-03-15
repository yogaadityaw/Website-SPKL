<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardPegawaiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-pegawai';
        return view('dashboard-pegawai', compact('type_menu'));
    }
}
