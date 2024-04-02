<?php

namespace App\Http\Controllers\DashboardAdminController;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ChangeRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $users = User::with('role')->orderBy('user_nip', 'desc')->get();
        $roles = Role::all();
        $type_menu = 'change-role';
        return view('admin-views.change-role', compact('type_menu', 'users', 'roles'));
    }

    public function updateRole(Request $request, $id_user)
    {
        // Ambil user dari database
    $user = User::findOrFail($id_user);

    // Validasi data yang dikirimkan dari form
    $request->validate([
        'role_id' => 'required|exists:roles,id',
    ]);

    // Ambil data yang dikirimkan dari form
    $data = $request->all();

    // Update role user
    $user->role_id = $data['role_id'];
    $user->save();

    // Redirect ke halaman index user atau halaman lain sesuai kebutuhan
    return redirect()->route('users.update')->with('success', 'User role has been updated successfully.');
    }
}
