<?php

namespace App\Http\Controllers\DashboardKabengController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKabengController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-kabeng';
        return view('dashboard-kabeng', compact('type_menu'));
    }
}
