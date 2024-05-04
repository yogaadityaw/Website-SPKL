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
        return view('dashboard-kabeng');
    }
}
