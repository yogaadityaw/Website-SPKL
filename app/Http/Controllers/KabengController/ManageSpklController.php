<?php

namespace App\Http\Controllers\KabengController;

use App\Http\Controllers\Controller;
use App\Models\Spkl;
use Illuminate\Http\Request;

class ManageSpklController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    public function index()
    {

        $spkls = Spkl::all();

        return view('kabeng-views.create-spkl', compact('spkls'));
    }
}
