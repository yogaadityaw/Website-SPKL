<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $type_menu = 'dashboard'; 
        return view('dashboard', compact('type_menu'));
    }
}
