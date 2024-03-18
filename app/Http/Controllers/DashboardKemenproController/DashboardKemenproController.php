<?php

namespace App\Http\Controllers\DashboardKemenproController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardKemenproController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-kemenpro';
        return view('dashboard-kemenpro', compact('type_menu'));
    }
}
