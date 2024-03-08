<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Return_;

class DashboardController extends Controller
{
    public function kabeng()
    {
        $type_menu = 'dashboard_kabeng'; 
        return view('dashboard_kabeng', compact('type_menu'));
    }

    public function departemen()
    {
        return view ('dashboard_departemen');
    }

    public function kemenpro()
    {
        return view ('dashboard_kemenpro');
    }

    public function admin()
    {
        return view ('dashboard_admin');
    }
    
    public function pegawai()
    {
        return view ('dashboard_pegawai');
    }

    public function user()
    {
        $type_menu = 'dashboard_user'; 
        return view ('dashboard_user', compact('type_menu'));
    
    }

}
