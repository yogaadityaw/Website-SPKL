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
        $type_menu = 'dashboard_departemen'; 
        return view('dashboard_departemen', compact('type_menu'));
    }
   
    public function kemenpro()
    {
        $type_menu = 'dashboard_kemenpro'; 
        return view('dashboard_kemenpro', compact('type_menu'));
    }

    public function admin()
    {
        $type_menu = 'dashboard_admin'; 
        return view('dashboard_admin', compact('type_menu'));
    }
    
    public function pegawai()
    {
        $type_menu = 'dashboard_pegawai'; 
        return view('dashboard_pegawai', compact('type_menu'));
    }

    public function user()
    {
        $type_menu = 'dashboard_user'; 
        return view ('dashboard_user', compact('type_menu'));
    
    }

}
