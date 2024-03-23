<?php

namespace App\Http\Controllers\DashboardAdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ChangeRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $users = User::with('role')->orderBy('user_nip', 'desc')->get();
        
        $type_menu = 'change-role';
        return view('admin-views.change-role', compact('type_menu', 'users'));
    }

    public function updateRole()
    {
    }
}
