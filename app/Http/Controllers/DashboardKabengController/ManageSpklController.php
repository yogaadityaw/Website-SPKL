<?php

namespace App\Http\Controllers\DashboardKabengController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ManageSpklController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $type_menu = 'create-spkl';
        return view('kabeng-views.create-spkl', compact('type_menu'));
    }
}
