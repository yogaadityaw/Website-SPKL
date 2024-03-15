<?php

namespace App\Http\Controllers\DashboardController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardUserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'dashboard-user';
        return view('dashboard-user', compact('type_menu'));
    }
}
