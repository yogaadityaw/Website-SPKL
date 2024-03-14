<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboardKabeng()
    {
        $type_menu = 'dashboard-kabeng';
        return view('dashboard-kabeng', compact('type_menu'));
    }

    public function dashboardDepartemen()
    {
        $type_menu = 'dashboard-departemen';
        return view('dashboard-departemen', compact('type_menu'));
    }

    public function dashboardKemenpro()
    {
        $type_menu = 'dashboar-kemenpro';
        return view('dashboard-kemenpro', compact('type_menu'));
    }

    public function dashboardAdmin()
    {
        $type_menu = 'dashboard-admin';
        return view('dashboard-admin', compact('type_menu'));
    }

    public function dashboardPegawai()
    {
        $type_menu = 'dashboard-pegawai';
        return view('dashboard-pegawai', compact('type_menu'));
    }

    public function dashboardUser()
    {
        $type_menu = 'dashboard-user';
        return view('dashboard-user', compact('type_menu'));
    }
}
