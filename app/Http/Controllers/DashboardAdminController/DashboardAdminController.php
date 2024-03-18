<?php

namespace App\Http\Controllers\DashboardAdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-admin';
        return view('dashboard-admin', compact('type_menu'));
    }
}
