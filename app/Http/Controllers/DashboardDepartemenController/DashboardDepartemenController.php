<?php

namespace App\Http\Controllers\DashboardDepartemenController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardDepartemenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-departemen';
        return view('dashboard-departemen', compact('type_menu'));
    }
}
