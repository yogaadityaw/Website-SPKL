<?php

namespace App\Http\Controllers\KemenproController;

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
        return view('dashboard-kemenpro');
    }
}
