<?php

namespace App\Http\Controllers\DepartemenController;

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
        return view('dashboard-departemen');
    }
}
